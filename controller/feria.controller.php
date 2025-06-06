<?php
require_once 'model/feria.php';
require_once 'model/docente.php';
require_once 'model/usuario.php';


class FeriaController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new Feria();
    }

    public function Index(){
        require_once 'view/header.php';
        require_once 'view/feria/feria.php';
        require_once 'view/footer.php';   
    }
    
    public function Editar(){
        $alm = new Feria();
        $docentes = new Docente();

        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/feria/feria-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $alm = new Feria ();

        $alm->id = $_REQUEST['id'];
        $alm->nom_cur = $_REQUEST['nom_cur'];
        $alm->doc_ori = $_REQUEST['doc_ori'];
        $alm->tiem_eje = $_REQUEST['tiem_eje'];
        $alm->fecha_entrega = !empty($_POST['fecha_entrega']) ? $_POST['fecha_entrega'] : null;
        $alm->fecha_fin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
        $alm->est_por = $_REQUEST['est_por'];
        $alm->tip_pro = $_REQUEST['tip_pro'];
        $alm->archivo = $_FILES['archivo'];
        $alm->comentario = $_REQUEST['comentario'];
        $alm->jurado = $_REQUEST['jurado'];
        $alm->nota = $_REQUEST['nota'];
        $alm->estado = $_REQUEST['estado'];
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