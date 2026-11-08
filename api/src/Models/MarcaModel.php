<?php
namespace App\Models;

use PDO;

class MarcaModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function todas() {
        $stmt = $this->db->query('SELECT id_marca, nombre_marca, pais_origen FROM MARCAS ORDER BY nombre_marca');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
