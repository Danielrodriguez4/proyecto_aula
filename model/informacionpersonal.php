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

	public function Registrar(Estudiantes $data)
	{
		try 
		{
		$sql = "INSERT INTO informacionpersonal (nombre,apellido,num_id,codigo,semestre,telefono,sexo,correo,fecha_registro) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
                    $data->fecha_registro,
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}