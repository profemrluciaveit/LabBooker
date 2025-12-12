<?php
require_once __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($nombre) || empty($email) || empty($password)) {
        die("Todos los campos son obligatorios.");
    }

    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $email, $password]);

    header("Location: ../public/login.php");
    exit;
}
