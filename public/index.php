<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\DashboardController;
use Controllers\TareaController;
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
$router->post('/perfil',[DashboardController::class,'perfil']);

$router->post('/cambiar-password',[DashboardController::class,'cambiar_password']);
$router->get('/cambiar-password',[DashboardController::class,'cambiar_password']);


$router->get('/proyecto',[DashboardController::class,'proyecto']);


/* API */
$router->get('/api/tareas',[TareaController::class,'index']);
$router->post('/api/tarea',[TareaController::class,'crear']);
$router->post('/api/tarea/actualizar',[TareaController::class,'actualizar']);
$router->post('/api/tarea/eliminar',[TareaController::class,'eliminar']);

$router->post('/api/proyectoEliminar',[TareaController::class,'proyectoEliminar']);
$router->post('/api/proyectoActualizar',[TareaController::class,'proyectoActualizar']);





// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();