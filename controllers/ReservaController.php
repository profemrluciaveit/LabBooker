<?php
session_start();
require_once "../config/db.php";
require_once "../models/reserva.php";

//Para que se precise iniciar sesion para realizar la reserva
if (!isset($_SESSION["usuario_id"])) {
    echo "Debes iniciar sesión para reservar.";
    exit;
}

$laboratorio = $_POST["laboratorio_id"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];

//Conexion
$stmt = $conn->prepare("INSERT INTO reservas (usuario_id, laboratorio_id, fecha, hora_inicio) VALUES ($usuario, $laboratorio, $fecha, $hora_inicio)");

$stmt->bind_param("iiss", $_SESSION["usuario_id"], $usuario);

$stmt->execute();

header("Location: ../index.php?reserva=ok");
exit;
?>