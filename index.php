<?php
require_once 'model/database.php';
require_once 'model/user.php';

session_start();

// Lista de controladores públicos (no requieren sesión)
$publicControllers = ['login', 'registro'];

// Determinar controlador solicitado
$requestedController = strtolower($_REQUEST['c'] ?? 'login');

// Verificar si requiere autenticación
$requiresAuth = !in_array($requestedController, $publicControllers);

// Redirigir si no autenticado y es ruta protegida
if ($requiresAuth && !isset($_SESSION['user'])) {
    header('Location: /?c=login');
    exit();
}

// Si ya autenticado pero accediendo a ruta pública, redirigir a dashboard
if (!$requiresAuth && isset($_SESSION['user'])) {
    header('Location: /?c=dashboard');
    exit();
}

// Determinar controlador y acción finales
$controller = $requiresAuth ? $requestedController : (strtolower($_REQUEST['c'] ?? 'login'));
$action = $_REQUEST['a'] ?? 'Index';

// Construir ruta del controlador
$controllerFile = "controller/$controller.controller.php";

// Verificar existencia del controlador
if (!file_exists($controllerFile)) {
    error_log("Controlador no encontrado: $controllerFile");
    header('Location: /?c=login');
    exit();
}

require_once $controllerFile;

// Verificar existencia de la clase
$controllerClass = ucwords($controller) . 'Controller';
if (!class_exists($controllerClass)) {
    error_log("Clase de controlador no existe: $controllerClass");
    header('Location: /?c=login');
    exit();
}

// Verificar existencia del método
$controllerInstance = new $controllerClass;
if (!method_exists($controllerInstance, $action)) {
    error_log("Método no existe: $controllerClass::$action");
    header('Location: /?c=login');
    exit();
}

// Ejecutar la acción
call_user_func([$controllerInstance, $action]);