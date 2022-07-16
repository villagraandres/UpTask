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
       
        $router->render('auth/olvide',[
            'titulo'=>'Recupear Password'
        ]);
        
    }

    public static function reestablecer(Router $router){
      
        if($_SERVER['REQUEST_METHOD']==='POST'){

        }
        $router->render('auth/reestablecer',[
            'titulo'=>'Reestablecer Password'
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