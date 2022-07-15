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
      


        
        $router->render('auth/confirmar',[
            'titulo'=>'Confirmar'
        ]);
        
    }


    
}