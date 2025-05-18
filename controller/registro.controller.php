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

        $alm->nombre = $_POST['nombre'];
        $alm->apellido = $_POST['apellido'];
        $alm->num_id = $_POST['num_id'];
        $alm->codigo = $_POST['codigo'];
        $alm->semestre = $_POST['semestre'];
        $alm->telefono = $_POST['telefono'];
        $alm->sexo = $_POST['sexo'];
        $alm->correo = $_POST['correo'];
        $alm->password = $_POST['password'];
        $alm = $this->model->Registrar($alm);



        if ($alm) {
            $_SESSION['user'] = $alm;
            $estudiante->nombre = $_POST['nombre'];
            $estudiante->apellido = $_POST['apellido'];
            $estudiante->num_id = $_POST['num_id'];
            $estudiante->codigo = $_POST['codigo'];
            $estudiante->semestre = $_POST['semestre'];
            $estudiante->telefono = $_POST['telephone'];
            $estudiante->sexo = $_POST['sexo'];
            $estudiante->correo = $_POST['correo'];

            $estudiante->Registrar($estudiante);
            header('Location: /?c=dashboard');
        } else {
            //$e = "¡Correo o contraseña incorrectos!";
            require_once 'view/register.php';
        }
    }
}
