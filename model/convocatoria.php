<?php
class Convocatoria
{
	private $pdo;

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
		try
		{$result = array();
			if ($_SESSION['user']->rol == 1) {
				$stm = $this->pdo->prepare("SELECT * FROM convocatorias");
				$stm->execute();
			} else {
				$stm = $this->pdo->prepare("SELECT * FROM convocatorias WHERE user = ?");
				$stm->execute(array($_SESSION['user']->id));
			}

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

    // Obtener convocatoria por ID
    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM convocatorias WHERE id = ?");
            $stm->execute([$id]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Guardar nueva convocatoria
    public function Guardar($data)
{
    $sql = "INSERT INTO convocatorias (nombre, picture, apertura, cierre, user) VALUES (?, ?, ?, ?, ?)";
    $this->pdo->prepare($sql)->execute([
        $data->nombre,
        $data->picture,
        $data->apertura,
        $data->cierre,
        $data->user
    ]);
}

public function Actualizar($data)
{
    $sql = "UPDATE convocatorias SET nombre = ?, picture = ?, apertura = ?, cierre = ? WHERE id = ?";
    $this->pdo->prepare($sql)->execute([
        $data->nombre,
        $data->picture,
        $data->apertura,
        $data->cierre,
        $data->id
    ]);
}

}