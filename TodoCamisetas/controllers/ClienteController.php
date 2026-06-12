<?php
require_once 'models/Cliente.php';

class ClienteController {
    public static function index() {
        $clientes = Cliente::all();
        echo json_encode(["data" => $clientes]);
    }

    public static function show(int $id) {
        $cliente = Cliente::find($id);
        if ($cliente) {
            echo json_encode(["data" => $cliente]);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Cliente no encontrado"]);
        }
    }

    public static function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['rut']) || !isset($data['nombre_comercial'])) {
            http_response_code(400);
            echo json_encode(["error" => "RUT y Nombre Comercial son obligatorios"]);
            return;
        }
        
        if (Cliente::create($data)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Cliente creado"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error al guardar el cliente"]);
        }
    }

    public static function destroy(int $id) {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            http_response_code(404);
            echo json_encode(["error" => "Cliente no encontrado"]);
            return;
        }

        if (Cliente::delete($id)) {
            echo json_encode(["mensaje" => "Cliente eliminado exitosamente"]);
        }
    }
}