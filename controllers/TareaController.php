<?php
namespace Controllers;

use Model\Proyectos;
use Model\Tareas;

class TareaController{


    public static function index(){

        
        $proyectoUrl=s($_GET['url']);

        if(!$proyectoUrl){
            header('Location: /dashboard');
        }

        $proyecto=Proyectos::where('url',$proyectoUrl);

        session_start();

       if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']){
        header('Location: /404');
       }

       $tarea= Tareas::belongsTo('proyectoId',$proyecto->id);

       echo json_encode(['tareas'=>$tarea]);


    }

    public static function crear(){


        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            session_start();
            $proyecto= Proyectos::where('url',$_POST['proyectoId']);

           if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']){
            $respuesta=[
                'tipo'=>'error',
                'mensaje'=>'Hubo un Error al agregar la tarea'
            ];
            echo json_encode($respuesta);
            return;
           
           }

           //Todo bien

           $tarea= new Tareas($_POST);
           $tarea->proyectoId=$proyecto->id;
          $resultado= $tarea->guardar();

          if($resultado){

            $respuesta=[
                'tipo'=> 'exito',
                'id' => $resultado['id'],
                'mensaje'=>'Tarea creada correctamente'
              ];
              
           echo json_encode($respuesta);
          }
          

            
        }
    }

    public static function actualizar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }
    }
}