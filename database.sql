CREATE DATABASE IF NOT EXISTS labbooker;
USE labbooker;

-- Tabla de Usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tabla de Laboratorios
CREATE TABLE laboratorios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    capacidad INT NOT NULL
);

-- Tabla de Reservas
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    laboratorio_id INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (laboratorio_id) REFERENCES laboratorios(id)
);

-- DATOS DE PRUEBA
-- Laboratorios
INSERT INTO laboratorios (nombre, capacidad) VALUES 
('Laboratorio 1 (Programación)', 20),
('Laboratorio 2 (Sistemas Op.)', 15),
('Laboratorio 3 (Redes)', 10);

-- Usuarios de prueba
-- Nota: Para este ejercicio práctico la contraseña es texto plano '1234'.
INSERT INTO usuarios (nombre, email, password) VALUES 
('Estudiante Demo', 'test@alumno.edu.uy', '1234'),
('Profesor Admin', 'profe@dgetp.edu.uy', 'admin');