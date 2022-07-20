<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\DashboardController;
use MVC\Router;

$router = new Router();

//Login
$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);

//Crear cuenta
$router->get('/crear',[LoginController::class,'crear']);
$router->post('/crear',[LoginController::class,'crear']);

//Olvide Password
$router->get('/olvide',[LoginController::class,'olvide']);
$router->post('/olvide',[LoginController::class,'olvide']);
//Reestablecer asword

$router->get('/reestablecer',[LoginController::class,'reestablecer']);
$router->post('/reestablecer',[LoginController::class,'reestablecer']);

//Confirmacion
$router->get('/mensaje',[LoginController::class,'mensaje']);
$router->get('/confirmar',[LoginController::class,'confirmar']);

/* Proyectos */

$router->get('/dashboard',[DashboardController::class,'index']);
$router->get('/crear-proyecto',[DashboardController::class,'crear']);
$router->post('/crear-proyecto',[DashboardController::class,'crear']);
$router->get('/perfil',[DashboardController::class,'perfil']);
$router->get('/proyecto',[DashboardController::class,'proyecto']);





// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();