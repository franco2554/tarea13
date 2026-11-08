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

    public function crear() {
        $datos = json_decode(file_get_contents('php://input'), true);

        if (empty($datos['modelo']) || empty($datos['id_marca'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Faltan campos obligatorios'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $this->model->guardar($datos);
        echo json_encode(['status' => 'ok', 'message' => 'Auto guardado'], JSON_UNESCAPED_UNICODE);
    }

    public function actualizar($id) {
        $datos = json_decode(file_get_contents('php://input'), true);

        if (empty($datos['modelo']) || empty($datos['id_marca'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Faltan campos obligatorios'], JSON_UNESCAPED_UNICODE);
            return;
        }

        if (!$this->model->buscar($id)) {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'No se encontro un auto con ese id'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $this->model->actualizar($id, $datos);
        echo json_encode(['status' => 'ok', 'message' => 'Datos modificados correctamente'], JSON_UNESCAPED_UNICODE);
    }
}
