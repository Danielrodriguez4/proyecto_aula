<?php
class Evaluador
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
			$result = array();
			if ($_SESSION['user']->rol == 1) {
				$stm = $this->pdo->prepare("SELECT * FROM evaluadores");
				$stm->execute();
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}else{
				return [];
			}

			
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT * FROM evaluadores WHERE id = ?");


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
				->prepare("DELETE FROM evaluadores WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try {
			$sql = "UPDATE evaluadores SET 
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

	public function Registrar(Evaluador $data)
	{
		try {
			$sql = "INSERT INTO evaluadores (codigo,nombre,apellido,correo,cargo) 
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
