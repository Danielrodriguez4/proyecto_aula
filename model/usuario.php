<?php
class Usuario
{
	private $pdo;
    
    public $id;
    public $nombre;
    public $apellido;
    public $num_id;
    public $codigo;
    public $semestre;
    public $telefono;
    public $sexo;
    public $correo;
    public $cargo;
    public $fechaRegistro;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{$result = array();
			if ($_SESSION['user']->rol == 1) {
				$stm = $this->pdo->prepare("SELECT * FROM usuarios");
				$stm->execute();
			} else {
				$stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE user = ?");
				$stm->execute(array($_SESSION['user']->id));
			}

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuarios WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM usuarios WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE usuarios SET 
						nombre          = ?, 
						apellido        = ?,
						num_id          = ?,
						codigo          = ?,
						semestre          = ?,
						telefono         = ?,
                        sexo			 = ?,
                        correo        = ?
                        cargo        = ?
				    WHERE id = ? AND user = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						$data->nombre,
                        $data->apellido,
                        $data->num_id,
                        $data->codigo,
                        $data->semestre,
                        $data->telefono, 
                        $data->sexo, 
                        $data->correo,
                        $data->cargo,
                        $data->id,
						$_SESSION['user']->id 
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerPorCorreo($correo)
{
    try {
        $stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stm->execute(array($correo));
        return $stm->fetch(PDO::FETCH_OBJ);
    } catch (Exception $e) {
        error_log("Error en Usuario::ObtenerPorCorreo: " . $e->getMessage());
        return false;
    }
}

	public function Registrar(Usuario $data)
{
    try 
    {
        $sql = "INSERT INTO usuarios (nombre, apellido, num_id, codigo, semestre, telefono, sexo, correo, cargo, user) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; // 10 placeholders ahora

        $this->pdo->prepare($sql)
             ->execute(
                array(
                    $data->nombre,
                    $data->apellido,
                    $data->num_id,
                    $data->codigo,
                    $data->semestre,
                    $data->telefono, 
                    $data->sexo,
                    $data->correo,
                    $data->cargo,
                    $data->user // Usamos $data->user en lugar de $_SESSION['user']->id
                )
            );
            
        $student = new Usuario();
        $student = $this->Obtener_Codigo($data->codigo);
        $this->Registrar_Proyecto($data->proyecto, $student->id);
    } 
    catch (Exception $e) 
    {
        throw new Exception("Error al registrar usuario: " . $e->getMessage());
    }
}
	public function Registrar_Proyecto($id_proyecto, $id_usuario)
	{
		try{
			$sql = "INSERT INTO proyecto_usuario (id_proyecto,id_estudiante) VALUES (?,?)";
			$this->pdo->prepare($sql)
				->execute(
					array(
						$id_proyecto, $id_usuario
					)
					);
		}catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}