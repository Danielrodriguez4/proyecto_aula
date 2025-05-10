<?php
require_once 'model/evaluador.php';

class EvaluadoresController{

    private $model;

    public function __CONSTRUCT(){
       $this->model = new Evaluador();
    }

    public function Index(){
        require_once 'view/header.php';
        require_once 'view/evaluador/evaluador.php';
        require_once 'view/footer.php';
    }

    public function Editar(){
        $alm = new Evaluador();

        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/evaluador/evaluador-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $alm = new Evaluador();

        $alm->id = $_REQUEST['id'];
        $alm->codigo = $_REQUEST['codigo'];
        $alm->nombre = $_REQUEST['nombre'];
        $alm->apellido = $_REQUEST['apellido'];
        $alm->correo = $_REQUEST['correo'];
        $alm->cargo = $_REQUEST['cargo'];

        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);

        header('Location: /?c=evaluadores');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}