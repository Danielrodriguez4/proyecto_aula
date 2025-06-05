<?php
require_once 'model/asignatura.php';

class AsignaturasController {
    private $model;

    public function __CONSTRUCT() {
        $this->model = new Asignatura();
    }

    /**
     * Método básico para listar asignaturas (si llegaras a necesitarlo)
     * Puedes llamarlo desde otros controladores sin vista
     */
    public function Listar() {
        try {
            return $this->model->ListarTodas();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtener una asignatura por ID (para uso interno/API)
     */
    public function Obtener($id) {
        try {
            return $this->model->Obtener($id);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Registrar nueva asignatura (para carga masiva o desde otros controladores)
     */
    public function Registrar($codigo, $nombre) {
        try {
            return $this->model->Registrar($codigo, $nombre);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método para relación docente-asignatura
     */
    public function RelacionarDocente($docente_id, $asignatura_id) {
        try {
            $sql = "INSERT IGNORE INTO docente_asignatura (docente_id, asignatura_id) VALUES (?, ?)";
            $stmt = $this->model->getPdo()->prepare($sql);
            return $stmt->execute([$docente_id, $asignatura_id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}