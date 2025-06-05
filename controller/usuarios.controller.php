<?php
require_once 'model/usuario.php';
require_once 'model/user.php';
require_once 'model/informacionpersonal.php';

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
        
        // Validar que el estudiante exista en la tabla usuarios
        $usuarioModel = new Usuario();
        $existente = $usuarioModel->ObtenerPorCorreo($_REQUEST['correo']);
        
        if (!$existente && empty($_REQUEST['id'])) {
            $_SESSION['error_message'] = "El estudiante no está registrado en el sistema. Debe ser cargado primero mediante carga masiva.";
            header('Location: /?c=usuarios&a=Editar&id='.$_REQUEST['id']);
            return;
        }

        $alm->id = $_REQUEST['id'];
        $alm->nombre = $_REQUEST['nombre'];
        $alm->apellido = $_REQUEST['apellido'];
        $alm->num_id = $_REQUEST['num_id'];
        $alm->codigo = $_REQUEST['codigo'];
        $alm->semestre = $_REQUEST['semestre'];
        $alm->telefono = $_REQUEST['telefono'];
        $alm->sexo = $_REQUEST['sexo'];
        $alm->correo = $_REQUEST['correo'];
        $alm->cargo = $_REQUEST['cargo'];
        $alm->user = $existente ? $existente->user : $_SESSION['user']->id;

        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);

        header('Location: /?c=usuarios');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }

  public function CargaMasiva()
    {
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

            // Leer el archivo línea por línea
            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                $lineNumber++;
                
                // Saltar la cabecera
                if ($lineNumber == 1) continue;

                // Validar estructura básica (8 campos)
                if (count($data) < 8) {
                    $errorCount++;
                    $errors[] = "Línea $lineNumber: Faltan campos (se esperaban 8, encontró ".count($data);
                    continue;
                }

                // Limpiar y validar datos
                $nombre = trim($data[0]);
                $apellido = trim($data[1]);
                $num_id = trim($data[2]);
                $codigo = trim($data[3]);
                $semestre = trim($data[4]);
                $correo = trim($data[5]);
                $telefono = trim($data[6]);
                $sexo = trim($data[7]);

                // Validar correo institucional
                if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || stripos($correo, '@ufps.edu.co') === false) {
                    $errorCount++;
                    $errors[] = "Línea $lineNumber: Correo no válido o no institucional: $correo";
                    continue;
                }

                try {
                    // 1. Verificar si el usuario ya existe
                    $userModel = new User();
                    $existingUser = $userModel->Obtener($correo);
                    if ($existingUser) {
                        $errorCount++;
                        $errors[] = "Línea $lineNumber: El usuario ya existe: $correo";
                        continue;
                    }

                    // 2. Registrar el usuario
                    $newUser = new User();
                    $newUser->username = $correo;
                    $newUser->password = $num_id;  // Usar num_id como contraseña inicial
                    $newUser->rol = 2; // Rol estudiante

                    $registeredUser = $userModel->Registrar($newUser);
                    if (!$registeredUser) {
                        throw new Exception("Error al registrar usuario");
                    }

                    // 3. Registrar información personal
                    $infoModel = new InformacionPersonal();
                    $infoData = new InformacionPersonal();
                    $infoData->nombre = $nombre;
                    $infoData->apellido = $apellido;
                    $infoData->num_id = $num_id;
                    $infoData->codigo = $codigo;
                    $infoData->semestre = $semestre;
                    $infoData->telefono = $telefono;
                    $infoData->sexo = $sexo;
                    $infoData->correo = $correo;
                    $infoData->user = $registeredUser->id;

                    $infoModel->Registrar($infoData);

                    // 4. Registrar en tabla usuarios
                    $usuarioModel = new Usuario();
                    $usuarioData = new Usuario();
                    $usuarioData->nombre = $nombre;
                    $usuarioData->apellido = $apellido;
                    $usuarioData->num_id = $num_id;
                    $usuarioData->codigo = $codigo;
                    $usuarioData->semestre = $semestre;
                    $usuarioData->telefono = $telefono;
                    $usuarioData->sexo = $sexo;
                    $usuarioData->correo = $correo;
                    $usuarioData->user = $registeredUser->id;
                    $usuarioData->cargo = 0; // Valor por defecto

                    $usuarioModel->Registrar($usuarioData);

                    $successCount++;

                } catch (Exception $e) {
                    $errorCount++;
                    $errors[] = "Línea $lineNumber: Error - ".$e->getMessage();
                    continue;
                }
            }
            fclose($handle);

            // Preparar resultado
            $_SESSION['import_result'] = [
                'success' => $successCount,
                'errors' => $errorCount,
                'details' => $errors
            ];

        } catch (Exception $e) {
            $_SESSION['error_message'] = "Error en la carga masiva: ".$e->getMessage();
        }

        header('Location: /?c=usuarios');
    }
}