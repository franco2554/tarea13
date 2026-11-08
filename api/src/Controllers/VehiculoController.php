<?php
namespace App\Controllers;

use App\Models\VehiculoModel;

class VehiculoController {
    private $db;
    private $model;

    public function __construct($db) {
        $this->db = $db;
        $this->model = new VehiculoModel($db);
    }

    public function listar() {
        $vehiculos = $this->model->todos();
        echo json_encode(['status' => 'ok', 'vehiculos' => $vehiculos], JSON_UNESCAPED_UNICODE);
    }

    public function ver($id) {
        $vehiculo = $this->model->buscar($id);
        if (!$vehiculo) {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'No se encontro un auto con ese id'], JSON_UNESCAPED_UNICODE);
            return;
        }
        echo json_encode(['status' => 'ok', 'vehiculo' => $vehiculo], JSON_UNESCAPED_UNICODE);
    }
}
