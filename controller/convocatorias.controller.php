<?php
require_once 'model/convocatoria.php';
require_once 'model/evaluador.php';
require_once 'model/usuario.php';


class ConvocatoriasController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new Convocatoria();
    }

    public function Index(){
        require_once 'view/header.php';
        require_once 'view/convocatoria/convocatoria.php';
        require_once 'view/footer.php';   
    }
    
    public function Editar(){
        $alm = new Convocatoria();
        $docentes = new Evaluador();
        $estudiantes = new Usuario();

        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/convocatoria/convocatoria-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $alm = new Convocatoria();

        $alm->id = $_REQUEST['id'];
        $alm->nombre = $_REQUEST['nombre'];
        $alm->imagen = $_REQUEST['imagen'];
        $alm->apertura = $_REQUEST['apertura'];
        $alm->user = $_SESSION['user']->id;


        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);

        header('Location: /?c=convocatorias');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}