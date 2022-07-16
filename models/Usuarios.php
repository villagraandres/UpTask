<?php
namespace Model;

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

      
        if( $this->password && strlen($this->password)<8){
            self::$alertas['error'][]='El password debe contener al menos 8 caracteres';
        }

        if($this->password !== $this->password2){
            self::$alertas['error'][]='Las contraseñas no coinciden';
        }





        return self::$alertas;
    }

    public function hash(){
        $this->password=password_hash($this->password,PASSWORD_BCRYPT);
    }

    public function token(){
        $this->token= uniqid();
    }


}