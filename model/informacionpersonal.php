<?php
class InformacionPersonal
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
    public $fecha_registro;
    public $user;

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



	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM informacionpersonal WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerPorUsuario($userId)
{
    try {
        $stm = $this->pdo->prepare("SELECT * FROM informacionpersonal WHERE user = ?");
        $stm->execute(array($userId));
        return $stm->fetch(PDO::FETCH_OBJ);
    } catch (Exception $e) {
        error_log("Error en InformacionPersonal::ObtenerPorUsuario: " . $e->getMessage());
        return false;
    }
}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM informacionpersonal WHERE id = ?");			          

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
			$sql = "UPDATE informacionpersonal SET 
						nombre          = ?, 
						apellido        = ?,
						num_id          = ?,
						codigo          = ?,
						semestre          = ?,
						telefono         = ?,
                        sexo			 = ?,
                        correo        = ?
				    WHERE id = ?";

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
                        $data->id
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
        $stm = $this->pdo->prepare("SELECT * FROM informacionpersonal WHERE correo = ?");
        $stm->execute(array($correo));
        return $stm->fetch(PDO::FETCH_OBJ);
    } catch (Exception $e) {
        error_log("Error en InformacionPersonal::ObtenerPorCorreo: " . $e->getMessage());
        return false;
    }
}

public function Registrar($data)
	{
		try {
			$sql = "INSERT INTO informacionpersonal 
					(nombre, apellido, num_id, codigo, semestre, telefono, sexo, correo, user) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$this->pdo->prepare($sql)->execute([
				$data->nombre,
				$data->apellido,
				$data->num_id,
				$data->codigo,
				$data->semestre,
				$data->telefono,
				$data->sexo,
				$data->correo,
				$data->user
			]);

			return true;
		} catch (Exception $e) {
			error_log("Error en InformacionPersonal::Registrar: ".$e->getMessage());
			throw $e;
		}
	}
}