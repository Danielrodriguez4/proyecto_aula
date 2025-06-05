<?php
require_once 'model/proyecto.php';
require_once 'model/docente.php';
require_once 'model/asignatura.php'; // Añadir este require

class ProyectosController{
    private $model;

    public function __CONSTRUCT(){
        $this->model = new Proyecto();
    }

    // ... (métodos Index y Eliminar se mantienen igual)

    public function Editar(){
        $alm = new Proyecto();
        $docenteModel = new Docente();
        $asignaturaModel = new Asignatura(); // Nuevo modelo

        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        // Obtener docentes y asignaturas según el rol
        $docentes = $docenteModel->Listar();
        
        if($_SESSION['user']->rol == 1) {
            // Admin ve todas las asignaturas
            $asignaturas = $asignaturaModel->ListarTodas();
        } else {
            // Docente ve solo sus asignaturas
            $asignaturas = $asignaturaModel->ListarPorDocente($_SESSION['user']->id);
        }

        require_once 'view/header.php';
        require_once 'view/proyecto/proyecto-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $alm = new Proyecto();

        $alm->id = $_REQUEST['id'];
        $alm->grupo = $_REQUEST['grupo'];
        $alm->asignatura_id = $_REQUEST['asignatura']; // Cambiado a ID
        $alm->titulo = $_REQUEST['titulo'];
        $alm->num_est = $_REQUEST['num_est'];
        $alm->archivo = $_FILES['archivo'];
        $alm->estado = $_REQUEST['estado'];
        $alm->fecha_entrega = !empty($_POST['fecha_entrega']) ? $_POST['fecha_entrega'] : null;
        
        // Asignar docente según el rol
        if($_SESSION['user']->rol == 1) {
            $alm->docente_id = $_REQUEST['docente']; // Cambiado a ID
        } else {
            $alm->docente_id = $_SESSION['user']->id;
        }
        
        $alm->user_id = $_SESSION['user']->id;

        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);

        header('Location: /?c=proyectos');
    }
}