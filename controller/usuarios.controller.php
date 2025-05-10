<?php
require_once 'model/usuario.php';

class UsuariosController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new Usuario();
    }

    public function Index(){
        require_once 'view/header.php';
        require_once 'view/usuario/usuario.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $alm = new Usuario();

        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/usuario/usuario-editar.php';
        require_once 'view/footer.php';
    }

    public function Editar(){
        $alm = new Usuario();

        if(isset($_REQUEST['id'])){
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
        $alm->correo = $_REQUEST['correo'];
        $alm->telefono = $_REQUEST['telefono'];
        $alm->sexo = $_REQUEST['sexo'];
        $alm->proyecto = $_REQUEST['p'];
        $alm->feria = $_REQUEST['f'];

        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);

        header('Location: /?c=proyectos');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}