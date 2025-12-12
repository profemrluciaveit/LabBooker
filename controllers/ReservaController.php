<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Reserva.php';

if (!isset($_SESSION["usuario_id"])) {
    die("Debes iniciar sesión para reservar.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $laboratorio = $_POST["laboratorio"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $usuario_id = $_SESSION["usuario_id"];

    if (empty($laboratorio) || empty($fecha) || empty($hora)) {
        die("Todos los campos son obligatorios.");
    }

    if ($fecha < date("Y-m-d")) {
        die("No puedes reservar una fecha pasada.");
    }

    $reserva = new Reserva($usuario_id, $laboratorio, $fecha, $hora);

    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("INSERT INTO reservas (usuario_id, laboratorio_id, fecha, hora) VALUES (?, ?, ?, ?)");
    $stmt->execute([$reserva->usuario_id, $reserva->laboratorio_id, $reserva->fecha, $reserva->hora]);

    header("Location: ../public/index.php?ok=1");
    exit;
}
