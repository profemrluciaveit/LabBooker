<?php

require_once __DIR__ . '/../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/index.php');
    exit;
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../public/login.php?error=debe_loguearse'); // FIX
    exit;
}

$usuarioId = (int) $_SESSION['usuario_id'];
$laboratorioId = (int) ($_POST['laboratorio_id'] ?? 0);
$fecha = trim($_POST['fecha'] ?? '');
$hora = trim($_POST['hora'] ?? '');

if ($laboratorioId === "" || $fecha === '' || $hora === '') {
    header('Location: ../public/index.php?error=campos_vacios');
    exit;
}


if (!ctype_digit((string) $laboratorio_id)) {
    header('Location: ../public/index.php?error=laboratorio_invalido');
    exit;
}
$laboratorio_id = (int) $laboratorio_id;


$dt = DateTime::createFromFormat('Y-m-d H:i', $fecha . ' ' . $hora);
$errors = DateTime::getLastErrors();

if ($dt === false || ($errors['warning_count'] ?? 0) > 0 || ($errors['error_count'] ?? 0) > 0) {
    header('Location: ../public/index.php?error=fecha_hora_invalida');
    exit;
}


$ahora = new DateTime('now');
if ($dt < $ahora) {
    header('Location: ../public/index.php?error=fecha_pasada');
    exit;
}


$conn = getConnection();

$sqlLab = "SELECT id FROM laboratorios WHERE id = ? LIMIT 1";
$stmtLab = $conn->prepare($sqlLab);
if (!$stmtLab) {
    $conn->close();
    header('Location: ../public/index.php?error=error_db');
    exit;
}
$stmtLab->bind_param("i", $laboratorio_id);
$stmtLab->execute();
$resLab = $stmtLab->get_result();
$stmtLab->close();

if ($resLab->num_rows !== 1) {
    $conn->close();
    header('Location: ../public/index.php?error=laboratorio_no_existe');
    exit;
}


$sql = "INSERT INTO reservas (usuario_id, laboratorio_id, fecha, hora) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    $conn->close();
    header('Location: ../public/index.php?error=error_db');
    exit;
}

header('Location: ../public/index.php?error=error_db');
exit;