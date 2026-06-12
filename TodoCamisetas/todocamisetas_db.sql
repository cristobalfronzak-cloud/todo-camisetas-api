DROP DATABASE IF EXISTS todocamisetas_db;
CREATE DATABASE todocamisetas_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE todocamisetas_db;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_comercial VARCHAR(100) NOT NULL,
    rut VARCHAR(20) NOT NULL UNIQUE,
    direccion VARCHAR(255) NOT NULL,
    categoria ENUM('Regular', 'Preferencial') DEFAULT 'Regular',
    contacto_nombre VARCHAR(100) NOT NULL,
    contacto_correo VARCHAR(150) NOT NULL,
    porcentaje_oferta INT DEFAULT 0 COMMENT 'Descuento en porcentaje (ej: 15 para 15%)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE camisetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_producto VARCHAR(50) NOT NULL UNIQUE,
    titulo VARCHAR(150) NOT NULL,
    club VARCHAR(100) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    color VARCHAR(50) NOT NULL,
    precio_base INT NOT NULL,
    detalles TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tallas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(10) NOT NULL UNIQUE
);

CREATE TABLE camiseta_talla (
    camiseta_id INT NOT NULL,
    talla_id INT NOT NULL,
    PRIMARY KEY (camiseta_id, talla_id),
    FOREIGN KEY (camiseta_id) REFERENCES camisetas(id) ON DELETE CASCADE,
    FOREIGN KEY (talla_id) REFERENCES tallas(id) ON DELETE CASCADE
);

INSERT INTO clientes (nombre_comercial, rut, direccion, categoria, contacto_nombre, contacto_correo, porcentaje_oferta) VALUES 
('90minutos', '76.123.456-K', 'Providencia, Santiago', 'Preferencial', 'Matías López', 'compras@90minutos.cl', 15),
('tdeportes', '77.987.654-1', 'Concepción, Biobío', 'Regular', 'Camila Fuentes', 'contacto@tdeportes.cl', 0);

INSERT INTO camisetas (codigo_producto, titulo, club, pais, tipo, color, precio_base, detalles) VALUES 
('SCL2025L', 'Camiseta Local 2025 - Selección Chilena', 'Selección Chilena', 'Chile', 'Local', 'Rojo', 45000, 'Edición aniversario 2025 con parche oficial.'),
('ESP2024V', 'Camiseta Visita 2024 - España', 'Selección Española', 'España', 'Visita', 'Amarillo', 50000, 'Tecnología transpirable, versión jugador.'),
('CC2025L', 'Camiseta Local 2025 - Colo Colo', 'Colo Colo', 'Chile', 'Local', 'Blanco y Negro', 40000, 'Auspiciador principal en el pecho.');

INSERT INTO tallas (nombre) VALUES 
('S'), ('M'), ('L'), ('XL'), ('XXL');
INSERT INTO camiseta_talla (camiseta_id, talla_id) VALUES 
(1, 1), (1, 2), (1, 3);
INSERT INTO camiseta_talla (camiseta_id, talla_id) VALUES 
(2, 2), (2, 3), (2, 4);
INSERT INTO camiseta_talla (camiseta_id, talla_id) VALUES 
(3, 1), (3, 2), (3, 3), (3, 4), (3, 5);