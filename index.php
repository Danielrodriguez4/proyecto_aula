<?php
require_once 'model/database.php';

session_start();
if (isset($_REQUEST['c']) && $_REQUEST['c'] != 'login' && $_REQUEST['c'] != 'registro') {
    if (isset($_SESSION['user'])) {
        $controller = strtolower($_REQUEST['c']);
        $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

        require_once "controller/$controller.controller.php";
        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;

        call_user_func(array($controller, $accion));
    } else {
        header('Location: /');
    }
} else {
    if (!isset($_SESSION['user'])) {
        $controller = strtolower($_REQUEST['c']) ? $_REQUEST['c'] : 'login';
        $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

        require_once "controller/$controller.controller.php";
        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;
        call_user_func(array($controller, $accion));
    } else {
        header('Location: /?c=dashboard');
    }
}
