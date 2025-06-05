<?php
class Evaluar
{
	private $pdo;
	private $dir_subida = './files/uploads/';

	public $nota;
    public $nota1;
    public $nota2;
    public $nota3;
    public $nota4;
    public $nota5;
    public $nota6;
    public $nota7;
    public $nota8;
    public $nota9;
    public $notafin;

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
				->prepare("SELECT * FROM evaluar WHERE id = ?");


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
				->prepare("DELETE FROM evaluar WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try {
			$sql = "UPDATE evaluar SET 

					nota =?,
                    nota1 =?,
                    nota2 =?,
                    nota3 =?,
                    nota4 =?,
                    nota5 =?,
                    nota6 =?,
                    nota7 =?,
                    nota8 =?,
                    nota9 =?,
                    notafin =?,
				    WHERE id = ?";
			if ($data->archivo['name']) {
				$fichero_subido = $this->dir_subida . basename($data->archivo['name']);
				if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
					$datos = array(
						
						$data->nota,
                        $data->nota1,
                        $data->nota2,
                        $data->nota3,
                        $data->nota4,
                        $data->nota5,
                        $data->nota6,
                        $data->nota7,
                        $data->nota8,
                        $data->nota9,
                        $data->notafin,
					);
				}
			} else {
				$sql = "UPDATE evaluar SET 
					nota =?,
                    nota1 =?,
                    nota2 =?,
                    nota3 =?,
                    nota4 =?,
                    nota5 =?,
                    nota6 =?,
                    nota7 =?,
                    nota8 =?,
                    nota9 =?,
                    notafin =?, 

				    WHERE id = ?";

				$datos = array(
						$data->nota,
                        $data->nota1,
                        $data->nota2,
                        $data->nota3,
                        $data->nota4,
                        $data->nota5,
                        $data->nota6,
                        $data->nota7,
                        $data->nota8,
                        $data->nota9,
                        $data->notafin,
					
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

	public function Registrar(Evaluar $data)
	{
		try {
			$sql = "INSERT INTO evaluar (nota,nota1,nota2,nota3,nota4,nota5,nota6,nota7,nota8,nota9,notafin,user) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$fichero_subido = $this->dir_subida . basename($data->archivo['name']);
			if (move_uploaded_file($data->archivo['tmp_name'], $fichero_subido)) {
			}
			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->nota,
                        $data->nota1,
                        $data->nota2,
                        $data->nota3,
                        $data->nota4,
                        $data->nota5,
                        $data->nota6,
                        $data->nota7,
                        $data->nota8,
                        $data->nota9,
                        $data->notafin,
                        $data->user,
					)
				);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
