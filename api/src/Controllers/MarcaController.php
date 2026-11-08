<?php
namespace App\Controllers;

use App\Models\MarcaModel;

class MarcaController {
    private $db;
    private $model;

    public function __construct($db) {
        $this->db = $db;
        $this->model = new MarcaModel($db);
    }

    public function listar() {
        $marcas = $this->model->todas();
        echo json_encode(['status' => 'ok', 'marcas' => $marcas], JSON_UNESCAPED_UNICODE);
    }
}
