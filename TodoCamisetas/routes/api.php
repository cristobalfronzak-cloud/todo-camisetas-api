<?php

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/todocamisetas', '', $uri);

if ($method === 'GET' && preg_match('/^\/api\/camisetas\/?$/', $uri)) {
    CamisetaController::index();
} 
elseif ($method === 'GET' && preg_match('/^\/api\/camisetas\/(\d+)$/', $uri, $matches)) {
    CamisetaController::show((int)$matches[1]);
} 
elseif ($method === 'POST' && preg_match('/^\/api\/camisetas\/?$/', $uri)) {
    CamisetaController::store();
} 
elseif ($method === 'DELETE' && preg_match('/^\/api\/camisetas\/(\d+)$/', $uri, $matches)) {
    CamisetaController::destroy((int)$matches[1]);
}

elseif ($method === 'GET' && preg_match('/^\/api\/clientes\/?$/', $uri)) {
    ClienteController::index();
} 
elseif ($method === 'GET' && preg_match('/^\/api\/clientes\/(\d+)$/', $uri, $matches)) {
    ClienteController::show((int)$matches[1]);
} 
elseif ($method === 'POST' && preg_match('/^\/api\/clientes\/?$/', $uri)) {
    ClienteController::store();
} 
elseif ($method === 'DELETE' && preg_match('/^\/api\/clientes\/(\d+)$/', $uri, $matches)) {
    ClienteController::destroy((int)$matches[1]);
}

elseif ($method === 'GET' && preg_match('/^\/api\/tallas\/?$/', $uri)) {
    TallaController::index();
} 
elseif ($method === 'POST' && preg_match('/^\/api\/tallas\/asignar\/?$/', $uri)) {
    TallaController::asignar();
}

else {
    http_response_code(404);
    echo json_encode([
        "error" => "Endpoint no encontrado",
        "metodo_usado" => $method,
        "ruta_solicitada" => $uri
    ]);
}