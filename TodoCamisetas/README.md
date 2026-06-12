# 👕 TodoCamisetas API — Sistema Backend de Gestión B2B

Bienvenido al repositorio oficial de **TodoCamisetas**, una solución API RESTful robusta desarrollada en **PHP Puro (sin frameworks)** y estructurada bajo el patrón **Modelo-Vista-Controlador (MVC)**. 

Este sistema actúa como la columna vertebral tecnológica para la automatización del inventario y la gestión logística de relaciones comerciales B2B con tiendas minoristas a nivel nacional (como *Tienda 90minutos* y *Tienda tdeportes*).

---

## 🚀 Características Principales
* **Arquitectura Limpia:** Separación estricta de responsabilidades usando el patrón MVC.
* **Enrutamiento Avanzado:** Despachador de tráfico basado en expresiones regulares en PHP puro.
* **Persistencia Segura:** Acceso a datos mediante PDO con consultas preparadas contra inyecciones SQL.
* **Lógica de Precios Dinámica (Descuentos):** Cálculo logístico en tiempo real de precios preferenciales según la categoría del cliente.
* **Formato Estándar:** Respuestas 100% consistentes con cabeceras `Content-Type: application/json`.

---

## 📁 Arquitectura y Diseño de Archivos

El proyecto prescinde intencionalmente de frameworks externos para demostrar la capacidad de abstracción y modularidad de la arquitectura nativa en PHP.

```text
TodoCamisetas/
├── config/
│   └── database.php       # Conexión única a la base de datos usando el patrón Singleton (PDO)
├── controllers/
│   ├── CamisetaController.php  # Captura de peticiones, respuestas JSON y validación de productos
│   ├── ClienteController.php   # Control de flujo y gestión de clientes mayoristas
│   └── TallaController.php     # Lógica distribuidora para la asignación física de tallas
├── models/
│   ├── Camiseta.php       # Consultas SQL nativas y cálculo de lógica de negocio para productos
│   ├── Cliente.php        # Persistencia de datos tributarios y categorías comerciales
│   └── Talla.php          # Abstracción relacional Muchos a Muchos para control de stock
├── routes/
│   └── api.php            # Router central basado en la evaluación de expresiones regulares
├── .htaccess              # Motor de reescritura de Apache para soporte de URLs amigables
├── index.php              # Front Controller (Punto de entrada único, CORS, cabeceras globales)
├── todocamisetas_db.sql   # Script SQL con estructura relacional y datos de prueba precargados
├── swagger.yaml           # Especificación técnica OpenAPI 3.0 para pruebas en Swagger UI
└── TodoCamisetas_Postman.json  # Colección completa de endpoints lista para importar en Postman
```

Explicación de componentes:
* **index.php:** Actúa como controlador frontal; intercepta todas las peticiones, configura las cabeceras Access-Control y el Content-Type: application/json.
* **routes/api.php:** Funciona como un despachador que utiliza expresiones regulares para identificar la ruta solicitada y delegar la ejecución al método estático adecuado en los controllers.
* **controllers/:** Reciben la solicitud, validan la existencia de datos obligatorios en el request y coordinan la comunicación con la capa de persistencia (models).
* **models/:** Encapsulan toda la lógica de acceso a datos (PDO::prepare) garantizando seguridad contra inyecciones SQL y coherencia en las operaciones CRUD.

## 📁 Detalle de endpoints
| Método | Endpoint | Expresión regular | Propósito Endpoint |
| --- | --- | --- | --- |
| GET | /api/camisetas | /api\/camisetas\/?$/ | Obtener lista completa de camisetas. |
| GET | /api/camisetas/{id} | /api\/camisetas\/(\d+)$/ | Detalle de camiseta (soporta cálculo de precio dinámico). |
| POST | /api/camisetas | /api\/camisetas\/?$/ | Crear un nuevo registro de camiseta. |
| PUT | /api/camisetas/{id} | /api\/camisetas\/(\d+)$/ | Actualizar los atributos de una camiseta existente. |
| DELETE | /api/camisetas/{id} | /api\/camisetas\/(\d+)$/ | Eliminar una camiseta del inventario. |
| GET | /api/clientes | /api\/clientes\/?$/ | Listar todos los clientes comerciales. |
| POST | /api/clientes | /api\/clientes\/?$/ | Registrar un nuevo cliente B2B. |
| POST | /api/tallas/asignar | /api\/tallas\/asignar\/?$/ | Vincular una camiseta a una talla (Relación M:N). |
(Nota: La expresión (\d+) en las regex se utiliza para capturar de forma dinámica el ID numérico enviado por el cliente en la ruta, el cual es inyectado posteriormente como parámetro en el método del controlador correspondiente.)