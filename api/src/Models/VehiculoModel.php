<?php
namespace App\Models;

use PDO;

class VehiculoModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function todos() {
        $stmt = $this->db->query('SELECT v.id_vehiculo, v.modelo, v.anio, v.precio, v.estado, m.nombre_marca
                                  FROM VEHICULOS v
                                  INNER JOIN MARCAS m ON v.id_marca = m.id_marca
                                  ORDER BY v.id_vehiculo');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id) {
        $stmt = $this->db->prepare('SELECT v.id_vehiculo, v.id_marca, v.modelo, v.anio, v.precio, v.estado, m.nombre_marca
                                    FROM VEHICULOS v
                                    INNER JOIN MARCAS m ON v.id_marca = m.id_marca
                                    WHERE v.id_vehiculo = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($datos) {
        $stmt = $this->db->prepare('INSERT INTO VEHICULOS (id_marca, modelo, anio, precio, estado)
                                    VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $datos['id_marca'],
            $datos['modelo'],
            $datos['anio'],
            $datos['precio'],
            $datos['estado']
        ]);
        return $this->db->lastInsertId();
    }

    public function actualizar($id, $datos) {
        $stmt = $this->db->prepare('UPDATE VEHICULOS SET id_marca = ?, modelo = ?, anio = ?, precio = ?, estado = ?
                                    WHERE id_vehiculo = ?');
        return $stmt->execute([
            $datos['id_marca'],
            $datos['modelo'],
            $datos['anio'],
            $datos['precio'],
            $datos['estado'],
            $id
        ]);
    }
}
