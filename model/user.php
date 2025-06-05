<?php
require_once 'informacionpersonal.php';


class User
{
	private $pdo;

	public $id;
	public $username;
	public $password;
	public $rol;


	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


   public function Obtener($username)
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT * FROM user WHERE username = ?");


			$stm->execute(array($username));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try {
			$stm = $this->pdo
				->prepare("DELETE FROM estudiantes WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

public function Registrar(User $data) {
    try {
        $password_hash = ($data->rol == 2) 
			? md5($data->password)  
			: md5($data->password); 

        $stmt = $this->pdo->prepare("INSERT INTO user (username, password, rol) VALUES (?, ?, ?)");
        $stmt->execute([
            $data->username,
            $password_hash,
            $data->rol ?? 2
        ]);

        return $this->Obtener($data->username);
    } catch (Exception $e) {
        error_log("Error en registro: " . $e->getMessage());
        return false;
    }
}

   public function Verificar($username, $password) {
    try {
        $user = $this->Obtener($username);
        if (!$user) return false;

        // Intento 1: Verificar con contraseña proporcionada
        if (hash_equals($user->password, md5($password))) {
            return $user;
        }

        // Intento 2: Solo para estudiantes - verificar con num_id
        if ($user->rol == 2) {
            $info = (new InformacionPersonal())->ObtenerPorUsuario($user->id);
            if ($info && hash_equals($user->password, md5($info->num_id))) {
                return $user;
            }
        }

        return false;
    } catch (Exception $e) {
        error_log("Error en verificación: " . $e->getMessage());
        return false;
    }
}


public function ObtenerPorCorreo($correo)
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT * FROM user WHERE username = ?");
			$stm->execute(array($correo));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
	
	
