<?php
require_once 'model/user.php';
require_once 'model/docente.php';
require_once 'model/informacionpersonal.php';


class LoginController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new User();
    }


    public function Index()
    {
        require_once 'view/login.php';
    }

public function Verificar()
{
    try {
        $username = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        
        if (empty($username) || empty($password)) {
            throw new Exception("Usuario y contraseña son requeridos");
        }
        
        $user = $this->model->Verificar($username, $password);
        
        if ($user) {
            // Obtener información adicional del usuario
            $infoModel = new InformacionPersonal();
            $userInfo = $infoModel->ObtenerPorUsuario($user->id);
            
            // Configurar sesión
            $_SESSION['user'] = $user;
            $_SESSION['user']->nombre = $userInfo->nombre ?? '';
            $_SESSION['user']->apellido = $userInfo->apellido ?? '';
            
            // Redirección basada en rol
            switch($user->rol) {
                case 1: header('Location: /?c=admin'); break;
                case 2: header('Location: /?c=estudiante'); break;
                case 3: header('Location: /?c=docente'); break;
                default: header('Location: /?c=login');
            }
            exit();
        }
        
        // Mensaje de error específico
        $userExists = $this->model->Obtener($username);
        $errorMsg = $userExists ? 
            "Contraseña incorrecta. Para estudiantes, use su número de identificación" : 
            "Usuario no encontrado";
            
        $_SESSION['login_error'] = $errorMsg;
        header('Location: /?c=login');
        exit();
        
    } catch (Exception $e) {
        $_SESSION['login_error'] = "Error en el sistema: " . $e->getMessage();
        header('Location: /?c=login');
        exit();
    }
}
}
