<?php
class Asignatura {
    private $pdo;

    public function __CONSTRUCT() {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }

    public function ListarTodas() {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM asignaturas");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM asignaturas WHERE id = ?");
            $stm->execute([$id]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorCodigo($codigo) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM asignaturas WHERE codigo = ?");
            $stm->execute([$codigo]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar($codigo, $nombre) {
        try {
            $sql = "INSERT INTO asignaturas (codigo, nombre) VALUES (?, ?)";
            $this->pdo->prepare($sql)->execute([$codigo, $nombre]);
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarPorDocente($docente_id) {
        try {
            $sql = "SELECT a.* FROM asignaturas a 
                    JOIN docente_asignatura da ON a.id = da.asignatura_id
                    WHERE da.docente_id = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$docente_id]);
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($id, $codigo, $nombre) {
        try {
            $sql = "UPDATE asignaturas SET codigo = ?, nombre = ? WHERE id = ?";
            $stmt = $this->model->getPdo()->prepare($sql);
            return $stmt->execute([$codigo, $nombre, $id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id) {
        try {
            // Primero eliminar relaciones con docentes
            $sqlRel = "DELETE FROM docente_asignatura WHERE asignatura_id = ?";
            $this->model->getPdo()->prepare($sqlRel)->execute([$id]);
            
            // Luego eliminar la asignatura
            $sql = "DELETE FROM asignaturas WHERE id = ?";
            $stmt = $this->model->getPdo()->prepare($sql);
            return $stmt->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}