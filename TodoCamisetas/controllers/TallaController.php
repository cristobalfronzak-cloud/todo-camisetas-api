<?php
require_once 'models/Talla.php';

class TallaController {
    public static function index() {
        $tallas = Talla::all();
        echo json_encode(["data" => $tallas]);
    }

    public static function asignar() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['camiseta_id']) && isset($data['talla_id'])) {
            Talla::asignarTallaACamiseta($data['camiseta_id'], $data['talla_id']);
            http_response_code(201);
            echo json_encode(["mensaje" => "Talla asignada correctamente"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Falta camiseta_id o talla_id"]);
        }
    }
}