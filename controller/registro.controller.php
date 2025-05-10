<?php
require_once 'model/user.php';
require_once 'model/usuario.php';



class RegistroController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new User();
    }


    public function Index()
    {
        require_once 'view/register.php';
    }

    public function Registrar()
    {
        $alm = new User();
        $estudiante = new Usuario();

        $alm->code = $_POST['code'];
        $alm->name = $_POST['name'];
        $alm->last_name = $_POST['last_name'];
        $alm->telephone = $_POST['telephone'];
        $alm->sexo = $_POST['sexo'];
        $alm->email = $_POST['email'];
        $alm->password = $_POST['password'];
        $alm = $this->model->Registrar($alm);



        if ($alm) {
            $_SESSION['user'] = $alm;
            $estudiante->codigo = $_POST['code'];
            $estudiante->nombre = $_POST['name'];
            $estudiante->apellido = $_POST['last_name'];
            $estudiante->telefono = $_POST['telephone'];
            $estudiante->sexo = $_POST['sexo'];
            $estudiante->correo = $_POST['email'];

            $estudiante->Registrar($estudiante);
            header('Location: /?c=dashboard');
        } else {
            //$e = "¡Correo o contraseña incorrectos!";
            require_once 'view/register.php';
        }
    }
}
