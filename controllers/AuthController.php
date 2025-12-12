<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        die("Todos los campos son obligatorios.");
    }

    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        die("Usuario no encontrado.");
    }

    // Para este ejercicio la contraseña está en texto plano (según tu profe)
    if ($password !== $usuario["password"]) {
        die("Contraseña incorrecta.");
    }

    $_SESSION["usuario_id"] = $usuario["id"];
    $_SESSION["usuario_nombre"] = $usuario["nombre"];

    header("Location: ../public/index.php");
    exit;
}
