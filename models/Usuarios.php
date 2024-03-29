<?php
namespace Model;

//self hace referencia a Active record mientras que static a la clase instanciada
//Use $this to refer to the current object. Use self to refer to the current class. In other words, use $this->member for non-static members, use self::$member for static members.
class Usuarios extends ActiveRecord{
    protected static $tabla= 'usuarios';
    protected static $columnasDB=['id','nombre','email','password','token','confirmado'];

    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->email=$args['email'] ?? '';
        $this->password=$args['password'] ?? '';
        $this->password2=$args['password2'] ?? '';
        $this->passwordActual=$args['passworActual'] ?? '';
        $this->passwordNuevo=$args['passwordNuevo'] ?? '';
        $this->token=$args['token'] ?? '';
        $this->confirmado=$args['confirmado'] ?? 0;
    }

    //Valiacion nueva cuenta

    public function validarCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }

        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][]='El email no es valido';
      }
      
        if( $this->password && strlen($this->password)<8){
            self::$alertas['error'][]='El password debe contener al menos 8 caracteres';
        }

        if($this->password !== $this->password2){
            self::$alertas['error'][]='Las contraseñas no coinciden';
        }





        return self::$alertas;
    }

    public function validarOlvide(){
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
              self::$alertas['error'][]='El email no es valido';
        }
        
        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }

        if( $this->password && strlen($this->password)<8){
            self::$alertas['error'][]='El password debe contener al menos 8 caracteres';
        }

        
        if($this->password !== $this->password2){
            self::$alertas['error'][]='Las contraseñas no coinciden';
        }

        
        return self::$alertas;
    }
    public function validarLogin()
    {
        
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][]='El email no es valido';
      }

        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }

        return self::$alertas;
    }

    public function validar_perfil(){
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][]='El email no es valido';
      }
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }

        return self::$alertas;
    }



    public function nuevoPassoword() :array{
        if(!$this->passwordActual){
            self::$alertas['error'][]='Introduce el password actual';
        }

        if(!$this->passwordNuevo){
            self::$alertas['error'][]='Introduce el password nuevo';
        }

        if($this->passwordNuevo && strlen($this->passwordNuevo)<8){
            self::$alertas['error'][]='El password debe ser mayor de 8 caracteres';
        }

        return self::$alertas;

    }

    public function comprobarPassword() :bool{




        return password_verify($this->passwordActual,$this->password);
    }

    public function hash(){
        $this->password=password_hash($this->password,PASSWORD_BCRYPT);
    }

    public function token(){
        $this->token= uniqid();
    }


}