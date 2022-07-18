<?php
namespace Controllers;

use Model\Usuarios;
use MVC\Router;
use Classes\mail;

class LoginController{


    public static function login(Router $router){
       
        if($_SERVER['REQUEST_METHOD']==='POST'){

        }

        //vista
        $router->render('auth/login',[
            'titulo'=>'Iniciar Sesión'
        ]);
    }

    public static function crear(Router $router){


       $alertas=[];
        $usuario= new Usuarios();

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario->sincronizar($_POST);
           
            $alertas=$usuario->validarCuenta();

            if(empty($alertas)){
                //Revisar si ya existe el usuario

                $existeUsuario= Usuarios::where('email',$usuario->email);
                if($existeUsuario){
                    Usuarios::setAlerta('error','El usuario ya esta registrado');
                
                }else{
                    //Crear
                    $usuario->hash();
                  
                    //Eliminar password 2
                    unset($usuario->password2);

                    //Generar token
                    $usuario->token();

                 $resultado=  $usuario->guardar();
                 
                    //Enviar correo

                    $mail= new mail();
                    $mail->confirmar($usuario->nombre,$usuario->email,$usuario->token);


                 if($resultado){
                    header('Location: /mensaje');
                 }



                }
            }
          
        }


        $alertas=Usuarios::getAlertas();
        
        //vista
        $router->render('auth/crear',[
           'titulo'=>'Crear Cuenta',
           'usuario'=>$usuario,
           'alertas'=>$alertas
       ]);
   }

    public static function logout(){
        echo "desde logout";
        
    }

   

    
    public static function olvide(Router $router){
    $alertas=[];

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario= new Usuarios($_POST);
            $alertas=$usuario->validarOlvide();

            if(empty($alertas)){
                $usuario=$usuario->where('email',$usuario->email);

       
                if($usuario && $usuario->confirmado === "1"){

                    //Generar nuevo token
                    $usuario->token();
                    

                    //Actualizar
                   $resultado= $usuario->guardar();
                   if($resultado){

                     //Enviar email
                    $mail= new mail();
                    $mail->reestablecer($usuario->nombre,$usuario->email,$usuario->token);

                    //Alerta
                    Usuarios::setAlerta('exito','Hemos enviado las instrucciones a tu correo');
                   }else{
                    Usuarios::setAlerta('error','Ha ocurrido un problema');
                   }                  
                    
                }else{
                    Usuarios::setAlerta('error','El usuario no existe o aun no esta confirmado');
                  
                }
            }

        }
        $alertas=Usuarios::getAlertas();
        $router->render('auth/olvide',[
            'titulo'=>'Recupear Password',
            'alertas'=>$alertas
        ]);
        
    }

    public static function reestablecer(Router $router){

        $token=s($_GET['token']);
        $mostrar=true;
        

        if(!$token){
            header('Location: /');
        }


        //Encontrar usuario
         $usuario= Usuarios::where('token',$token);

        if(empty($usuario)){
            Usuarios::setAlerta('error','Token no valido');      
            $mostrar=false;
        }

      
        if($_SERVER['REQUEST_METHOD']==='POST'){
        //sicronizamos el arreglo que encontramos con el token y lo sincronizamos con el nuevo POST
        $usuario->sincronizar($_POST);
        $alertas= $usuario->validarPassword();

        if(empty($alertas)){
            //Hash
            $usuario->hash();


            $usuario->token="";


            //Guardar

            $resultado=$usuario->guardar();

            if($resultado){
                header('Location: /?resultado=1');
            }
        }

        }

        $alertas=Usuarios::getAlertas();
        $router->render('auth/reestablecer',[
            'titulo'=>'Reestablecer Password',
            'alertas'=>$alertas,
            'mostrar'=>$mostrar
        ]);
        
    }

    public static function mensaje(Router $router){
       
        $router->render('auth/mensaje',[
            'titulo'=>'Instrucciones'
        ]);
    }

    public static function confirmar(Router $router){
      $token=s($_GET['token']);
      
      if(!$token){
        header('Location: /');

      }


      //Encontrar usuario
      $usuario= Usuarios::where('token',$token);
      
      if(empty($usuario)){
        Usuarios::setAlerta('error','Token no valido');
      }else{
        //Confirmar

        
        $usuario->confirmado=1;
        $usuario->token="";
        unset($usuario->password2);
        
        $resultado=$usuario->guardar();

        Usuarios::setAlerta('exito','Cuenta Comprobada Correctamente');

      }



        $alertas= Usuarios::getAlertas();
        $router->render('auth/confirmar',[
            'titulo'=>'Confirmar',
            'alertas'=>$alertas
        ]);
        
    }


    
}