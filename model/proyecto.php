<?php
class Proyecto
{
	private $pdo;
	private $dir_subida = './files/uploads/';

	public $id;
	public $titulo;
	public $descripcion;
	public $fecha_entrega;
	public $estado;
	public $archivo;
	public $comentario;
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

	public function Listar($table_search)
	{
		try {
			$result = array();
			if ($_SESSION['user']->rol == 1) {
				if ($table_search) {
					$stm = $this->pdo->prepare("SELECT * FROM proyectos WHERE titulo LIKE '%" .$table_search."%'" );
				} else {
					$stm = $this->pdo->prepare("SELECT * FROM proyectos WHERE estado != 4");
				} 
				$stm->execute();
			} else {
				if ($table_search) {
					$stm = $this->pdo->prepare("SELECT * FROM proyectos WHERE user = ? AND titulo LIKE '%" .$table_search."%'" );
				} else {
					$stm = $this->pdo->prepare("SELECT * FROM proyectos WHERE user = ?");
				} 
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
				->prepare("SELECT * FROM proyectos WHERE id = ?");


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
				->prepare("DELETE FROM proyectos WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try {
			$sql = "UPDATE proyectos SET 
						titulo          = ?, 
						descripcion        = ?,
						archivo            = ?,
						estado 			=?,
						comentario		=?,
						director		=?,
						jurado1		=?,
						jurado2		=?,
						jurado3		=?,
						nota		=?
				    WHERE id = ?";
			if ($data->archivo['name']) {
				$fichero_subido = $this->dir_subida . basename($data->archivo['name']);
				if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
					$datos = array(
						$data->title,
						$data->description,
						$fichero_subido,
						$data->estado,
						$data->comentario,
						$data->director,
						$data->jurado1,
						$data->jurado2,
						$data->jurado3,
						$data->nota,
						$data->id
					);
				}
			} else {
				$sql = "UPDATE proyectos SET 
						titulo          = ?, 
						descripcion        = ?,
						estado 			=?,
						comentario		=?,
						director		=?,
						jurado1		=?,
						jurado2		=?,
						jurado3		=?,
						nota		=?
				    WHERE id = ?";

				$datos = array(
					$data->title,
					$data->description,
					$data->estado,
					$data->comentario,
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

	public function Registrar(Proyecto $data)
	{
		try {
			$sql = "INSERT INTO proyectos (titulo,descripcion,archivo,user) 
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
