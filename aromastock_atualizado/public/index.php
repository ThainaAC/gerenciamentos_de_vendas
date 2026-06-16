<?php

session_start();

require_once "../app/config/Database.php";
require_once "../app/config/Auth.php";
require_once "../app/helpers/Validator.php";

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

$controllerName = ucfirst($controller) . "Controller";
$controllerFile = "../app/controllers/" . $controllerName . ".php";

if (!file_exists($controllerFile)) {
    die("Controller não encontrado.");
}

require_once $controllerFile;

$obj = new $controllerName();

if (!method_exists($obj, $action)) {
    die("Ação não encontrada.");
}

$obj->$action();
