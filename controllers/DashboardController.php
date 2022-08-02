<?php
namespace Controllers;

use Model\Proyectos;
use Model\Usuarios;
use MVC\Router;

class DashboardController{

    public static function index(Router $router){

        session_start();
        isAuth();

        $id=$_SESSION['id'];
        $resultados=Proyectos::belongsTo('propietarioId',$id);
        

        $router->render('dashboard/index',[
            'titulo'=>'Proyectos',
            'proyectos'=>$resultados
        ]);
    }

    public static function crear(Router $router){

        session_start();

        isAuth();

        $alertas=[];


        if($_SERVER['REQUEST_METHOD']==='POST'){
            $proyecto= new Proyectos($_POST);

            $alertas=$proyecto->validar();


            if(empty($alertas)){
                //Generar una URL unica
                
                $proyecto->url=md5(uniqid());

                
                //Generar el creador del proyecto

                $proyecto->propietarioId=$_SESSION['id'];

              $resultado=$proyecto->guardar();
              if($resultado){
                header('Location: /proyecto?url='.$proyecto->url);
              }


            }
        }

        $router->render('dashboard/crear-proyecto',[
            'titulo'=>'Crear Proyecto',
            'alertas'=>$alertas
        ]);
    }

    public static function perfil(Router $router){
        session_start();

        
        isAuth();

        $alertas=[];


        $usuario=Usuarios::find($_SESSION['id']);

     if($_SERVER['REQUEST_METHOD']==='POST'){
        $usuario->sincronizar($_POST);

        $alertas=$usuario->validar_perfil();
       

        if(empty($alertas)){

            $existe=Usuarios::where('email',$usuario->email);
            

            if($existe && $existe->id !== $usuario->id){
                
             Usuarios::setAlerta('error','Ya existe una cuenta con este email');

            $alertas=Usuarios::getAlertas();
            }else{
            $usuario->guardar();

            Usuarios::setAlerta('exito','Guardado Correctamente');

            $alertas=Usuarios::getAlertas();

            //Actualizamos la
            $_SESSION['nombre']=$usuario->nombre;

            }
            

        }
     }


     
        $router->render('dashboard/perfil',[
            'titulo'=>'Perfil',
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
    }

    public static function proyecto(Router $router){
        session_start();

        isAuth();

        $token=s($_GET['url']);

        if(!$token){
            header('Location: /dashboard');
        }
      
        //Revisar que la persona quien visita el proyecto es quien la creo
        $proyecto=Proyectos::where('url',$token);

      

        if(  $proyecto->propietarioId  !==  $_SESSION['id']){
            header('Location: /dashboard');
        }
       

        $router->render('dashboard/proyecto',[
           'titulo'=>$proyecto->proyecto
        ]);
    }

    public static function cambiar_password(Router $router){
        session_start();
        $alertas=[];


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario= Usuarios::find($_SESSION['id']);

            //sincronizar con datos de post

            $usuario->sincronizar($_POST);

            $alertas= $usuario->nuevoPassoword();


            if(empty($alertas)){
                $resultado= $usuario->comprobarPassword();

                

                if($resultado){
                    //Asignar el nuevo Password
                    unset($usuario->passwordActual);
        
                    $usuario->password=$usuario->passwordNuevo;

                    $usuario->hash();

                 $resultado = $usuario->actualizar();

                 if($resultado){
                    Usuarios::setAlerta('exito','Password actualizado correctamente');
                 }              
                }else{
                    //Alertas

                    Usuarios::setAlerta('error','El password actual es incorrecto');
                    
                }
            }         
        }


        $alertas= Usuarios::getAlertas();
        $router->render('dashboard/cambiar-password',[
            'titulo'=>'Cambiar Passoword',
            'alertas'=>$alertas
        ]);

    }

}

