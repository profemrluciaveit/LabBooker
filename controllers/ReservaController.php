<?php
require_once '../config/db.php';

session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['nombre'])) {
    echo "Error: Debes iniciar sesión para hacer una reserva.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $laboratorio_id = $_POST['laboratorio_id'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $usuario_id = $_SESSION['id'];

    if (empty($laboratorio_id) || empty($fecha) || empty($hora)) {
        echo "Error: Todos los campos son obligatorios.";
        exit();
    }

    $hoy = date('Y-m-d');
    if ($fecha < $hoy) {
        echo "Error: No puedes reservar en fechas anteriores a hoy.";
        exit();
    }

    $sql = "INSERT INTO reservas (usuario_id, laboratorio_id, fecha, hora) VALUES ('$usuario_id', '$laboratorio_id', '$fecha', '$hora')";

    $resultado = $conn->query($sql);
    
    if ($resultado) {
        header("Location: ../public/index.php");
        exit();
    } else {
        echo "Error al registrar la reserva: " . $conn->error;
        exit();
    }

} else {
    header("Location: ../public/index.php");
    exit();
}
?>
