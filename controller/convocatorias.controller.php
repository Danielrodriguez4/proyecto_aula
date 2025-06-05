<?php
require_once 'model/convocatoria.php';

class ConvocatoriasController
{
    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Convocatoria();
    }

    public function Index()
    {
        $convocatorias = $this->model->Listar();
        require_once 'view/header.php';
        require_once 'view/convocatoria/convocatoria.php';
        require_once 'view/footer.php';
    }

    public function Editar()
    {
        $alm = new stdClass();
        if (isset($_REQUEST['id'])) {
            $alm = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'view/header.php';
        require_once 'view/convocatoria/convocatoria-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar()
    {
        $alm = new stdClass();
        $alm->id = $_POST['id'];
        $alm->nombre = $_POST['nombre'];
        $alm->apertura = $_POST['apertura'];
        $alm->cierre = $_POST['cierre'];
        $alm->user = $_SESSION['user']->id;

        // Procesar imagen (picture)
        if (!empty($_FILES['picture']['name'])) {
            $nombreImagen = uniqid() . "_" . basename($_FILES['picture']['name']);
            $rutaImagen = 'assets/convocatorias/' . $nombreImagen;

            if (move_uploaded_file($_FILES['picture']['tmp_name'], $rutaImagen)) {
                $alm->picture = $nombreImagen;
            } else {
                $alm->picture = $_POST['picture_actual'] ?? null;
            }
        } else {
            $alm->picture = $_POST['picture_actual'] ?? null;
        }

        if ($alm->id > 0) {
            $this->model->Actualizar($alm);
        } else {
            $this->model->Guardar($alm);
        }

        header('Location: ?c=Convocatorias');
        exit();
    }

    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: ?c=Convocatorias');
        exit();
    }
}