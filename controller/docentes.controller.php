<?php
require_once 'model/docente.php';
require_once 'model/user.php';
require_once 'model/proyecto.php';
require_once 'model/asignatura.php';

class DocentesController{

    private $model;
    private $asignaturaModel;
    private $pdo;

    public function __CONSTRUCT() {
        try {
            $this->pdo = Database::StartUp();
            $this->model = new Docente();
            $this->asignaturaModel = new Asignatura(); // Instancia del modelo de asignaturas
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Index() {
        if(!isset($_SESSION['user'])) {
            header('Location: /?c=login');
            exit;
        }

        try {
            $docentes = $this->model->Listar();
            require_once 'view/header.php';
            require_once 'view/docente/docente.php';
            require_once 'view/footer.php';
        } catch (Exception $e) {
            error_log("Error en DocentesController: ".$e->getMessage());
            die("Error al cargar docentes");
        }
    }

    public function Editar() {
        $alm = new Docente();

        if(isset($_REQUEST['id'])) {
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/docente/docente-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar() {
        $alm = new Docente();
        $userModel = new User();

        $alm->id = $_REQUEST['id'] ?? null;
        $alm->codigo = $_REQUEST['codigo'];
        $alm->nombre = $_REQUEST['nombre'];
        $alm->apellido = $_REQUEST['apellido'];
        $alm->correo = $_REQUEST['correo'];
        $alm->cargo = $_REQUEST['cargo'];

        if (strpos($alm->correo, '@ufps.edu.co') === false) {
            $_SESSION['error'] = "Solo correos institucionales (@ufps.edu.co)";
            header('Location: /?c=docentes&a=Editar');
            return;
        }

        try {
            if ($alm->id > 0) {
                $this->model->Actualizar($alm);
            } else {
                $userData = new User();
                $userData->username = $alm->correo;
                $userData->password = $alm->codigo;
                $userData->rol = 3;
                
                $userModel->Registrar($userData);
                $this->model->Registrar($alm);
            }
            header('Location: /?c=docentes');
        } catch (Exception $e) {
            die("Error al guardar: " . $e->getMessage());
        }
    }

    public function Eliminar() {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }

    public function ListarAsignaturasDocente($docente_id)
    {
        try {
            $sql = "SELECT a.* FROM asignaturas a 
                    JOIN docente_asignatura da ON a.id = da.asignatura_id
                    WHERE da.docente_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$docente_id]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function CargaMasiva() {
        try {
            if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] != UPLOAD_ERR_OK) {
                throw new Exception("Debe seleccionar un archivo CSV válido");
            }

            $filePath = $_FILES['archivo']['tmp_name'];
            $handle = fopen($filePath, "r");
            if ($handle === false) {
                throw new Exception("No se pudo abrir el archivo");
            }

            $successCount = 0;
            $errorCount = 0;
            $errors = [];
            $lineNumber = 0;

            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                $lineNumber++;
                
                if ($lineNumber == 1) continue;

                if (count($data) < 3) {
                    $errorCount++;
                    $errors[] = "Línea $lineNumber: Faltan campos (se esperaban 3)";
                    continue;
                }

                $codigoDocente = trim($data[0]);
                $codigoAsignatura = trim($data[1]);
                $nombreAsignatura = trim($data[2]);

                try {
                    // 1. Obtener docente
                    $docente = $this->model->ObtenerPorCodigo($codigoDocente);
                    if (!$docente) {
                        throw new Exception("Docente con código $codigoDocente no encontrado");
                    }

                    // 2. Buscar o crear asignatura usando el modelo específico
                    $asignatura = $this->asignaturaModel->ObtenerPorCodigo($codigoAsignatura);
                    
                    if (!$asignatura) {
                        $this->asignaturaModel->Registrar($codigoAsignatura, $nombreAsignatura);
                        $asignatura = $this->asignaturaModel->ObtenerPorCodigo($codigoAsignatura);
                    }

                    // 3. Crear relación
                    $this->RelacionarDocenteAsignatura($docente->id, $asignatura->id);
                    
                    $successCount++;
                } catch (Exception $e) {
                    $errorCount++;
                    $errors[] = "Línea $lineNumber: Error - ".$e->getMessage();
                    continue;
                }
            }
            fclose($handle);

            $_SESSION['import_result'] = [
                'success' => $successCount,
                'errors' => $errorCount,
                'details' => $errors
            ];

        } catch (Exception $e) {
            $_SESSION['error_message'] = "Error en la carga masiva: ".$e->getMessage();
        }

        header('Location: /?c=docentes');
    }

    private function RelacionarDocenteAsignatura($docente_id, $asignatura_id) {
        try {
            $sql = "INSERT IGNORE INTO docente_asignatura (docente_id, asignatura_id) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$docente_id, $asignatura_id]);
        } catch (Exception $e) {
            throw new Exception("Error al relacionar docente con asignatura: ".$e->getMessage());
        }
    }

    // Método para obtener asignaturas de un docente (para usar en otros controladores)
    public function ObtenerAsignaturasDocente($docente_id) {
        try {
            $sql = "SELECT a.* FROM asignaturas a 
                    JOIN docente_asignatura da ON a.id = da.asignatura_id
                    WHERE da.docente_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$docente_id]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
