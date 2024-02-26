<?php

use App\Controllers\BaseController;

require "../vendor/autoload.php";

if ($_GET) {   
    $controller = $_GET['controller'];
    $metodo = $_GET['metodo'];

     $controllerClass = "App\\Controllers\\$controller";    

    $entity = new $controllerClass();
    $entity->$metodo();

} else {
    require_once 'Controllers/BaseController.php';
    $start = new BaseController();
    $start->Login();
}