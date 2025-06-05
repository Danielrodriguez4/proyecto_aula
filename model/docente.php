<?php
class Docente
{
	private $pdo;
	public $id;
	public $codigo;
	public $nombre;
	public $apellido;
	public $correo;
	public $cargo;

	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

public function Listar()
{
    try {
        $sql = "SELECT * FROM docentes";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
        error_log("Error en Docentes::Listar: ".$e->getMessage());
        return [];
    }
}


	public function Obtener($id)
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT * FROM docentes WHERE id = ?");


			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try {
			$stm = $this->pdo
				->prepare("DELETE FROM docentes WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try {
			$sql = "UPDATE docentes SET 
						codigo          = ?,
						nombre          = ?, 
						apellido        = ?,
						correo            = ?
						cargo            = ?
				    WHERE id = ?";
			//if ($data->archivo) {
			//	$fichero_subido = $this->dir_subida . basename($data->archivo['name']);
			//	if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
			//	}
			//}

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->codigo,
						$data->nombre,
						$data->apellido,
						$data->correo,
						$data->cargo,
						$data->id
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ObtenerPorCodigo($codigo) {
		try {
			$stm = $this->pdo->prepare("SELECT * FROM docentes WHERE codigo = ?");
			$stm->execute([$codigo]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Registrar(Docente $data)
	{
		try {
			$sql = "INSERT INTO docentes (codigo,nombre,apellido,correo,cargo) 
		        VALUES (?, ?, ?, ?, ?)";

			//$fichero_subido = $this->dir_subida . basename($data->archivo['name']);
			//if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
			//}
			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->codigo,
						$data->nombre,
						$data->apellido,
						$data->correo,
						$data->cargo,
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}