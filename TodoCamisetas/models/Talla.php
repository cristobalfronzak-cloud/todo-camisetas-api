<?php
require_once 'config/database.php';

class Talla {
    public static function all() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM tallas");
        return $stmt->fetchAll();
    }

    public static function asignarTallaACamiseta(int $camiseta_id, int $talla_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT IGNORE INTO camiseta_talla (camiseta_id, talla_id) VALUES (:cam, :tal)");
        return $stmt->execute(['cam' => $camiseta_id, 'tal' => $talla_id]);
    }
}