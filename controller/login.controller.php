<?php
require_once 'model/user.php';


class LoginController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new User();
    }


    public function Index(){
       require_once 'view/login.php';
    }

    public function Verificar(){
        $alm = new User();

        $username = $_POST['email'];
        $password = $_POST['password'];
        $alm = $this->model->Verificar($username, $password);
        if ($alm){
            $_SESSION['user'] = $alm;
            header('Location: /?c=dashboard');
        }else {
            $e = "¡Correo o contraseña incorrectos!";
            require_once 'view/login.php';
        }
    }
}