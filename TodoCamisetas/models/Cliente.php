<?php
require_once 'config/database.php';

class Cliente {
    public static function all() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM clientes");
        return $stmt->fetchAll();
    }

    public static function find(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

public static function create(array $data) {
        $db = Database::getConnection();
        $sql = "INSERT INTO clientes (nombre_comercial, rut, direccion, categoria, contacto_nombre, contacto_correo, porcentaje_oferta) 
                VALUES (:nombre_comercial, :rut, :direccion, :categoria, :contacto_nombre, :contacto_correo, :porcentaje_oferta)";
        
        $stmt = $db->prepare($sql);
        return $stmt->execute($data);
    }

    public static function update(int $id, array $data) {
        $db = Database::getConnection();
        $sql = "UPDATE clientes SET nombre_comercial = :nombre, categoria = :categoria WHERE id = :id";
        $data['id'] = $id;
        $stmt = $db->prepare($sql);
        return $stmt->execute($data);
    }

    public static function delete(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM clientes WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}