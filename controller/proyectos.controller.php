<?php
require_once 'model/proyecto.php';
require_once 'model/evaluador.php';
require_once 'model/usuario.php';


class ProyectosController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new Proyecto();
    }

    public function Index(){
        require_once 'view/header.php';
        require_once 'view/proyecto/proyecto.php';
        require_once 'view/footer.php';   
    }
    
    public function Editar(){
        $alm = new Proyecto();
        $docentes = new Evaluador();

        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/proyecto/proyecto-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $alm = new Proyecto();

        $alm->id = $_REQUEST['id'];
        $alm->title = $_REQUEST['title'];
        $alm->description = $_REQUEST['description'];
        $alm->archivo = $_FILES['archivo'];
        $alm->estado = $_REQUEST['estado'];
        $alm->comentario = $_REQUEST['comentario'];
        $alm->director = $_REQUEST['director'];
        $alm->jurado1 = $_REQUEST['jurado1'];
        $alm->jurado2 = $_REQUEST['jurado2'];
        $alm->jurado3 = $_REQUEST['jurado3'];
        $alm->nota = $_REQUEST['nota'];
        $alm->user = $_SESSION['user']->id;


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