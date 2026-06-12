<?php
require_once 'config/database.php';
require_once 'models/Cliente.php';

class Camiseta {
    public static function all() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM camisetas");
        return $stmt->fetchAll();
    }

    public static function find(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM camisetas WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

public static function create(array $data) {
        $db = Database::getConnection();
        $sql = "INSERT INTO camisetas (codigo_producto, titulo, club, pais, tipo, color, precio_base, detalles) 
                VALUES (:codigo_producto, :titulo, :club, :pais, :tipo, :color, :precio_base, :detalles)";
        
        $stmt = $db->prepare($sql);
        return $stmt->execute($data);
    }

    public static function delete(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM camisetas WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function getConPrecioFinal(int $camiseta_id, int $cliente_id) {
        $camiseta = self::find($camiseta_id);
        $cliente = Cliente::find($cliente_id);

        if (!$camiseta || !$cliente) {
            return null;
        }

        $precio_final = $camiseta['precio_base'];

        if ($cliente['categoria'] === 'Preferencial' && $cliente['porcentaje_oferta'] > 0) {
            $descuento = $precio_final * ($cliente['porcentaje_oferta'] / 100);
            $precio_final = $precio_final - $descuento;
        }

        $camiseta['precio_final'] = $precio_final;
        return $camiseta;
    }
}