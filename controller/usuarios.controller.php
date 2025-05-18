<?php
require_once 'model/usuario.php';
require_once 'model/user.php';

class UsuariosController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Usuario();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/usuario/usuario.php';
        require_once 'view/footer.php';
    }

    public function Crud()
    {
        $alm = new Usuario();

        if (isset($_REQUEST['id'])) {
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/usuario/usuario-editar.php';
        require_once 'view/footer.php';
    }

    public function Editar()
    {
        $alm = new Usuario();

        if (isset($_REQUEST['id'])) {
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/usuario/usuario-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $alm = new Usuario();

        $alm->id = $_REQUEST['id'];
        $alm->nombre = $_REQUEST['nombre'];
        $alm->apellido = $_REQUEST['apellido'];
        $alm->num_id = $_REQUEST['num_id'];
        $alm->codigo = $_REQUEST['codigo'];
        $alm->semestre = $_REQUEST['semestre'];
        $alm->telefono = $_REQUEST['telefono'];
        $alm->sexo = $_REQUEST['sexo'];
        $alm->correo = $_REQUEST['correo'];
        $alm->password = $_REQUEST['password'];

        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);

        header('Location: /?c=proyectos');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }

    public function CargaMasiva()
    {
        if (($open = fopen($_FILES['archivo']['tmp_name'], "r")) !== false) {
            $isHeader = true;
            while (($data = fgetcsv($open, 1000, ";")) !== false) {
                // Omitir la fila de encabezado
                if ($isHeader) {
                    $isHeader = false;
                    continue;
                }

                $user = new User();
                $user->nombre = $data[0];
                $user->apellido = $data[1];
                $user->num_id = $data[2];
                $user->codigo = $data[3];
                $user->semestre = $data[4];
                $user->telefono = $data[5];
                $user->sexo = $data[6];
                $user->correo = $data[7];
                $user->password = $data[8]; // Se encripta dentro del modelo
                $user->Registrar($user); // Registra en "user" e "informacionpersonal"
            }

            fclose($open);
        }

        header('Location: /?c=usuarios');
    }
}