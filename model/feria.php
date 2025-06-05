<?php
class Feria
{
	private $pdo;
	private $dir_subida = './files/uploads/';

	public $id;
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
			if ($_SESSION['user']->rol == 1) {
				if ($table_search) {
					$stm = $this->pdo->prepare("
						SELECT f.*, 
							doc_ori.nombre AS doc_ori_nombre, doc_ori.apellido AS doc_ori_apellido,
							jur.nombre AS jurado_nombre, jur.apellido AS jurado_apellido
						FROM ferias f 
						LEFT JOIN docentes doc_ori ON f.doc_ori = doc_ori.id 
						LEFT JOIN docentes jur ON f.jurado = jur.id 
						WHERE f.nom_cur LIKE ?
					");
					$stm->execute(["%$table_search%"]);
				} else {
					$stm = $this->pdo->prepare("
						SELECT f.*, 
							doc_ori.nombre AS doc_ori_nombre, doc_ori.apellido AS doc_ori_apellido,
							jur.nombre AS jurado_nombre, jur.apellido AS jurado_apellido
						FROM ferias f 
						LEFT JOIN docentes doc_ori ON f.doc_ori = doc_ori.id 
						LEFT JOIN docentes jur ON f.jurado = jur.id 
						WHERE f.estado != 4
					");
					$stm->execute();
				}
			} else {
				if ($table_search) {
					$stm = $this->pdo->prepare("
						SELECT f.*, 
							doc_ori.nombre AS doc_ori_nombre, doc_ori.apellido AS doc_ori_apellido,
							jur.nombre AS jurado_nombre, jur.apellido AS jurado_apellido
						FROM ferias f 
						LEFT JOIN docentes doc_ori ON f.doc_ori = doc_ori.id 
						LEFT JOIN docentes jur ON f.jurado = jur.id 
						WHERE f.user = ? AND f.nom_cur LIKE ?
					");
					$stm->execute([$_SESSION['user']->id, "%$table_search%"]);
				} else {
					$stm = $this->pdo->prepare("
						SELECT f.*, 
							doc_ori.nombre AS doc_ori_nombre, doc_ori.apellido AS doc_ori_apellido,
							jur.nombre AS jurado_nombre, jur.apellido AS jurado_apellido
						FROM ferias f 
						LEFT JOIN docentes doc_ori ON f.doc_ori = doc_ori.id 
						LEFT JOIN docentes jur ON f.jurado = jur.id 
						WHERE f.user = ?
					");
					$stm->execute([$_SESSION['user']->id]);
				}
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
        // Validar fechas
        $fecha_entrega = !empty($data->fecha_entrega) ? $data->fecha_entrega : null;
        $fecha_fin = !empty($data->fecha_fin) ? $data->fecha_fin : null;

        // Si hay archivo nuevo
        if (!empty($data->archivo['name'])) {
            $fichero_subido = $this->dir_subida . basename($data->archivo['name']);
            if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
                $sql = "UPDATE ferias SET 
                    nom_cur = ?, 
                    doc_ori = ?, 
                    tiem_eje = ?, 
                    est_por = ?, 
                    tip_pro = ?, 
                    archivo = ?, 
                    comentario = ?, 
                    jurado = ?, 
                    nota = ?, 
                    estado = ?
                WHERE id = ?";

                $datos = [
                    $data->nom_cur,
                    $data->doc_ori,
                    $data->tiem_eje,
                    $data->est_por,
                    $data->tip_pro,
                    $fichero_subido,
                    $data->comentario,
                    $data->jurado,
                    $data->nota ?? 0,
                    $data->estado,
                    $data->id
                ];
            }
        } else {
            // Sin nuevo archivo
            $sql = "UPDATE ferias SET 
                nom_cur = ?, 
                doc_ori = ?, 
                tiem_eje = ?,  
                est_por = ?, 
                tip_pro = ?, 
                comentario = ?, 
                jurado = ?, 
                nota = ?, 
                estado = ?
            WHERE id = ?";

            $datos = [
                $data->nom_cur,
                $data->doc_ori,
                $data->tiem_eje,
                $data->est_por,
                $data->tip_pro,
                $data->comentario,
                $data->jurado,
                $data->nota ?? 0,
                $data->estado,
                $data->id
            ];
        }

        // Ejecutar la consulta
        $this->pdo->prepare($sql)->execute($datos);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

	public function Registrar(Feria $data)
	{
		try {
			$sql = "INSERT INTO ferias (nom_cur,doc_ori,tiem_eje,fecha_entrega,fecha_fin,est_por,tip_pro,archivo,user) 
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
						$fichero_subido,
						$data->user
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
