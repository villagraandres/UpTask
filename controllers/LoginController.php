<?php
namespace Controllers;

use MVC\Router;

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
       
        
        //vista
        $router->render('auth/crear',[
           'titulo'=>'Crear Cuenta'
       ]);
   }

    public static function logout(){
        echo "desde logout";
        
    }

   

    
    public static function olvide(){
        echo "desde olvide";
        
    }

    public static function reestablecer(){
        echo "desde password";
        if($_SERVER['REQUEST_METHOD']==='POST'){

        }
    }

    public static function mensaje(){
        echo "desde login";
        
    }

    public static function confirmar(){
        echo "desde login";
        
    }


    
}