<?php
class Feria
{
	private $pdo;
	private $dir_subida = './files/uploads/';

	public $nom_cur;
	public $doc_ori;
	public $tiem_eje;
	public $fecha_entrega;
	public $fecha_fin;
	public $est_por;
	public $tip_pro;
	public $archivo;
	public $comentario;
	public $jurado;
	public $nota;
	public $estado;
	public $nombre;
	public $num_id;
	public $codigo;
	public $semestre;
	public $correo;
	public $telefono;


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
					$stm = $this->pdo->prepare("SELECT * FROM ferias WHERE titulo LIKE '%" .$table_search."%'" );
				} else {
					$stm = $this->pdo->prepare("SELECT * FROM ferias WHERE estado != 4");
				} 
				$stm->execute();
			} else {
				if ($table_search) {
					$stm = $this->pdo->prepare("SELECT * FROM ferias WHERE user = ? AND titulo LIKE '%" .$table_search."%'" );
				} else {
					$stm = $this->pdo->prepare("SELECT * FROM ferias WHERE user = ?");
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
				->prepare("SELECT * FROM ferias WHERE id = ?");


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
				->prepare("DELETE FROM ferias WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try {
			$sql = "UPDATE feria SET 

					nom_cur =?,
					doc_ori	=?,
					tiem_eje =?,
					fecha_entrega =?,
					fecha_fin =?,
					est_por =?,
					tip_pro =?,
					archivo =?,
					comentario =?,
					jurado =?,
					nota =?,
					estado =?,
					nombre =?,
					num_id =?,
					codigo =?,
					semestre =?,
					correo =?,
					telefono =?
				    WHERE id = ?";
			if ($data->archivo['name']) {
				$fichero_subido = $this->dir_subida . basename($data->archivo['name']);
				if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
					$datos = array(
						
						$data->nom_cur,
						$data->doc_ori,
						$data->tiem_eje,
						$data->fecha_entrega,
						$data->fecha_fin,
						$data->est_por,
						$data->tip_pro,
						$data->archivo,
						$data->comentario,
						$data->jurado,
						$data->nota,
						$data->estado,
						$data->nombre,
						$data->num_id,
						$data->codigo,
						$data->semestre,
						$data->correo,
						$data->telefono
					);
				}
			} else {
				$sql = "UPDATE feria SET 
					nom_cur =?,
					doc_ori	=?,
					tiem_eje =?,
					fecha_entrega =?,
					fecha_fin =?,
					est_por =?,
					tip_pro =?,
					archivo =?,
					comentario =?,
					jurado =?,
					nota =?,
					estado =?,
					nombre =?,
					num_id =?,
					codigo =?,
					semestre =?,
					correo =?,
					telefono =? 

				    WHERE id = ?";

				$datos = array(
						$data->nom_cur,
						$data->doc_ori,
						$data->tiem_eje,
						$data->fecha_entrega,
						$data->fecha_fin,
						$data->est_por,
						$data->tip_pro,
						$data->archivo,
						$data->comentario,
						$data->jurado,
						$data->nota ? $data->nota : 0,
						$data->estado,
						$data->nombre,
						$data->num_id,
						$data->codigo,
						$data->semestre,
						$data->correo,
						$data->telefono
					
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

	public function Registrar(Feria $data)
	{
		try {
			$sql = "INSERT INTO feria (nom_cur,doc_ori,tiem_eje,fecha_entrega,fecha_fin,est_por,tip_pro,archivo,user) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$fichero_subido = $this->dir_subida . basename($data->archivo['name']);
			if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
			}
			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->nom_cur,
						$data->doc_ori,
						$data->tiem_eje,
						$data->fecha_entrega,
						$data->fecha_fin,
						$data->est_por,
						$data->tip_pro,
						$data->archivo,
						$data->comentario,
						$data->user
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
