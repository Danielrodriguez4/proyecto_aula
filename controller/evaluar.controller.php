<?php
require_once 'model/evaluar.php';
require_once 'model/feria.php';
require_once 'model/docentes.php';
require_once 'model/usuario.php';


class EvaluarController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new Evaluar();
    }

    public function Index(){
        require_once 'view/header.php';
        require_once 'view/evaluar/evaluar.php';
        require_once 'view/footer.php';   
    }

    public function Guardar(){
        $alm = new Evaluar ();

        $alm->id = $_REQUEST['id'];
        $alm->nota = $_REQUEST['nota'];
        $alm->nota1 = $_REQUEST['nota1'];
        $alm->nota2 = $_REQUEST['nota2'];
        $alm->nota3 = $_REQUEST['nota3'];
        $alm->nota4 = $_REQUEST['nota4'];
        $alm->nota5 = $_REQUEST['nota5'];
        $alm->nota6 = $_REQUEST['nota6'];
        $alm->nota7 = $_REQUEST['nota7'];
        $alm->nota8 = $_REQUEST['nota8'];
        $alm->nota9 = $_REQUEST['nota9'];
        $alm->notafin = $_REQUEST['notafin'];
        $alm->user = $_SESSION['user']->id;


        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);

        header('Location: /?c=feria');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}