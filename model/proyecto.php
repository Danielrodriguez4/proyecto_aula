<?php
class Proyecto
{
	public $id;
    public $grupo;
    public $asignatura_id; // Cambiado de 'asignatura' a 'asignatura_id'
    public $titulo;
    public $num_est;
    public $archivo;
    public $estado;
    public $fecha_entrega;
    public $docente_id; // Cambiado de 'docente' a 'docente_id'
    public $user_id; // Cambiado de 'user' a 'user_id'
    private $pdo;
    private $dir_subida = './files/uploads/';



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

	 // Actualizar método Listar para incluir datos relacionados
    public function Listar($table_search) {
        try {
            $sql = "SELECT p.*, 
                   a.nombre as asignatura_nombre,
                   d.nombre as docente_nombre,
                   d.apellido as docente_apellido
                   FROM proyectos p
                   LEFT JOIN asignaturas a ON p.asignatura_id = a.id
                   LEFT JOIN docentes d ON p.docente_id = d.id
                   WHERE ";

            if ($_SESSION['user']->rol == 1) {
                $sql .= $table_search ? "p.titulo LIKE ?" : "p.estado != 4";
            } else {
                $sql .= $table_search ? "p.user_id = ? AND p.titulo LIKE ?" : "p.user_id = ?";
            }

            $stm = $this->pdo->prepare($sql);
            
            if ($_SESSION['user']->rol == 1) {
                $table_search ? $stm->execute(["%$table_search%"]) : $stm->execute();
            } else {
                $table_search ? $stm->execute([$_SESSION['user']->id, "%$table_search%"]) : $stm->execute([$_SESSION['user']->id]);
            }

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

	public function ObtenerAsignaturaPorCodigo($codigo) {
		try {
			$stm = $this->pdo->prepare("SELECT * FROM asignaturas WHERE codigo = ?");
			$stm->execute([$codigo]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function RegistrarAsignatura($codigo, $nombre) {
		try {
			$sql = "INSERT INTO asignaturas (codigo, nombre) VALUES (?, ?)";
			$this->pdo->prepare($sql)->execute([$codigo, $nombre]);
			return $this->pdo->lastInsertId();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

		public function Registrar(Proyecto $data) {
			try {
				$sql = "INSERT INTO proyectos 
					(grupo, asignatura_id, titulo, num_est, archivo, estado, fecha_entrega, docente_id, user_id) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

				$fichero_subido = $this->dir_subida . basename($data->archivo['name']); // Corregido 'archive' a 'archivo'
				
				if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
					$this->pdo->prepare($sql)->execute([
						$data->grupo,
						$data->asignatura_id,
						$data->titulo,
						$data->num_est,
						$fichero_subido,
						$data->estado,
						$data->fecha_entrega,
						$data->docente_id,
						$data->user_id
					]);
				} else {
					throw new Exception("Error al mover el archivo subido");
				}
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function Actualizar($data) {
			try {
				$sql = "UPDATE proyectos SET 
						grupo = ?, 
						asignatura_id = ?, 
						titulo = ?, 
						num_est = ?,
						archivo = ?,
						estado = ?,
						fecha_entrega = ?,
						docente_id = ?
						WHERE id = ?";

				$fichero_subido = $this->dir_subida . basename($data->archivo['name']);
				
				if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
					$this->pdo->prepare($sql)->execute([
						$data->grupo,
						$data->asignatura_id,
						$data->titulo,
						$data->num_est,
						$fichero_subido,
						$data->estado,
						$data->fecha_entrega,
						$data->docente_id,
						$data->id
					]);
				} else {
					// Si no hay archivo nuevo, actualizar sin cambiar el archivo
					$sql = "UPDATE proyectos SET 
							grupo = ?, 
							asignatura_id = ?, 
							titulo = ?, 
							num_est = ?,
							estado = ?,
							fecha_entrega = ?,
							docente_id = ?
							WHERE id = ?";
							
					$this->pdo->prepare($sql)->execute([
						$data->grupo,
						$data->asignatura_id,
						$data->titulo,
						$data->num_est,
						$data->estado,
						$data->fecha_entrega,
						$data->docente_id,
						$data->id
					]);
				}
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
}

   
