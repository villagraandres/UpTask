<?php
namespace Controllers;

use Model\Proyectos;
use MVC\Router;

class DashboardController{

    public static function index(Router $router){

        session_start();

        isAuth();

        $router->render('dashboard/index',[
            'titulo'=>'Proyectos'
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

        $router->render('dashboard/perfil',[
            'titulo'=>'Perfil'
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
           debuguear("diferente");
        }
       

        $router->render('dashboard/proyecto',[
           'titulo'=>'Nombre del Proyecto'
        ]);
    }
}

