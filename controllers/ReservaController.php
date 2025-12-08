<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Reserva.php';

session_start();


if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php?error=debe_loguearse');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}


$usuarioId     = (int) $_SESSION['usuario_id'];
$laboratorioId = (int) ($_POST['laboratorio_id'] ?? 0);
$fecha         = trim($_POST['fecha'] ?? '');
$hora          = trim($_POST['hora']  ?? '');

if ($laboratorioId === 0 || $fecha === '' || $hora === '') {
    header('Location: ../index.php?error=campos_vacios');
    exit;
}


if (!filter_var($laboratorioId, FILTER_VALIDATE_INT)) {
    header('Location: ../index.php?error=laboratorio_invalido');
    exit;
}


$hoy          = new DateTime('today');
$fechaReserva = DateTime::createFromFormat('Y-m-d', $fecha);

if (!$fechaReserva || $fechaReserva < $hoy) {
    header('Location: ../index.php?error=fecha_pasada');
    exit;
}


$conn    = getConnection();
$reserva = new Reserva($usuarioId, $laboratorioId, $fecha, $hora);

if ($reserva->guardar($conn)) {
    header('Location: ../index.php?reserva=ok');
    exit;
} else {
    header('Location: ../index.php?error=error_db');
    exit;
}
