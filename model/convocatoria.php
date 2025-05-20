<?php
class Convocatoria
{
	private $pdo;
	private $dir_subida = './files/uploads/';

	public $nombre;
	public $imagen;
	public $apertura;
    

    public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

    public function Obtener($id)
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT * FROM convocatorias WHERE id = ?");


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
				->prepare("DELETE FROM convocatorias WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try {
			$sql = "UPDATE convocatoria SET 

					nombre =?,
					imagen =?,
					apertura	=?,
				    WHERE id = ?";
			if ($data->imagen['imagen']) {
				$fichero_subido = $this->dir_subida . basename($data->imagen['imagen']);
				if (move_uploaded_file($data->imagen['tmp_name'], $fichero_subido)) {
					$datos = array(
						
						$data->nombre,
						$fichero_subido,
						$data->apertura,

					);
				}
			} else {
				$sql = "UPDATE convocatoria SET 
					
					nombre	=?,
					apertura	=?,
					
				    WHERE id = ?";

				$datos = array(
						
					$data->nombre,
					$data->apertura,
						
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

	public function Registrar(Convocatoria $data)
	{
		try {
			$sql = "INSERT INTO convocatorias (nombre,imagen,apertura,user) 
		        VALUES (?, ?, ?, ?)";

			$fichero_subido = $this->dir_subida . basename($data->imagen['imagen']);
			if (move_uploaded_file($data->imagen['tmp_name'], $fichero_subido)) {
			}
			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->nombre,
						$fichero_subido,
						$data->apertura,
						$data->user
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

}