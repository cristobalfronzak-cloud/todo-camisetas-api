<?php
require_once 'models/Camiseta.php';

class CamisetaController {
    public static function index() {
        $camisetas = Camiseta::all();
        echo json_encode(["data" => $camisetas]);
    }

    public static function show(int $id) {
        if (isset($_GET['cliente_id'])) {
            $cliente_id = (int)$_GET['cliente_id'];
            $camiseta = Camiseta::getConPrecioFinal($id, $cliente_id);
        } else {
            $camiseta = Camiseta::find($id);
        }

        if ($camiseta) {
            echo json_encode(["data" => $camiseta]);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Camiseta no encontrada"]);
        }
    }

    public static function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['codigo_producto']) || !isset($data['precio_base'])) {
            http_response_code(400);
            echo json_encode(["error" => "Faltan campos obligatorios"]);
            return;
        }
        
        if (Camiseta::create($data)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Camiseta creada"]);
        }
    }

public static function destroy(int $id) {
        $camiseta = Camiseta::find($id);
        
        if (!$camiseta) {
            http_response_code(404);
            echo json_encode(["error" => "Camiseta no encontrada"]);
            return;
        }
        if (Camiseta::delete($id)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Camiseta eliminada exitosamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Hubo un problema al eliminar la camiseta"]);
        }
    }
}