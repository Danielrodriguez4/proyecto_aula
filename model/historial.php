<?php
class Historial
{
	private $pdo;
	private $dir_subida = './files/uploads/';

	public $id;
	public $titulo;
	public $estado;
	public $archivo;
	public $director;
	public $jurado1;
	public $jurado2;
	public $jurado3;
	public $nota;


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
				$stm = $this->pdo->prepare("SELECT * FROM proyectos WHERE estado = 4");
				$stm->execute(); 
			} else {
				$stm = $this->pdo->prepare("SELECT * FROM proyectos WHERE user = ? AND estado = 4");
				$stm->execute(array($_SESSION['user']->id));
			}

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT * FROM proyecto WHERE id = ?");


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
				->prepare("DELETE FROM historial WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try {
			$sql = "UPDATE historial SET 
						titulo          = ?, 
						archivo            = ?,
						estado 			=?,
						director		=?,
						jurado1		=?,
						jurado2		=?,
						jurado3		=?,
						nota		=?
				    WHERE id = ?";
			if ($data->archivo) {
				$fichero_subido = $this->dir_subida . basename($data->archivo['name']);
				if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
						$datos = array(
							$data->title,
							$fichero_subido,
							$data->estado,
							$data->director,
							$data->jurado1,
							$data->jurado2,
							$data->jurado3,
							$data->nota,
							$data->id
						);
				}
			}
			else{
				$sql = "UPDATE historial SET 
						titulo          = ?, 
						estado 			=?,
						director		=?,
						jurado1		=?,
						jurado2		=?,
						jurado3		=?,
						nota		=?
				    WHERE id = ?";
				$datos = array(
					$data->title,
					$data->estado,
					$data->director,
					$data->jurado1,
					$data->jurado2,
					$data->jurado3,
					$data->nota ? $data->nota : 0,
					$data->id
				);
			}

			$this->pdo->prepare($sql)
				->execute(
					$datos
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar(Historial $data)
	{
		try {
			$sql = "INSERT INTO historial (titulo,descripcion,archivo,user) 
		        VALUES (?, ?, ?, ?)";

			$fichero_subido = $this->dir_subida . basename($data->archivo['name']);
			if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
			}
			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->title,
						$data->description,
						$fichero_subido,
						$data->user
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
