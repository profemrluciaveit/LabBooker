<?php
require_once '../models/Reserva.php';
require_once '../db.php/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

// validar que el usuario tenga la sesión iniciada.
if (!isset($_SESSION['usuario_id'])) {
    echo "Acceso denegado. Debes iniciar sesión.";
    header("Location: login.html");
    exit;
}

// Recibir datos
    $laboratorio_id = $_POST['laboratorio'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];


// conectar a la base de datos
$conn = DB::connect();
 // 7. Insertar reserva
    $sql = "INSERT INTO reservas (usuario_id, laboratorio_id, fecha, hora) VALUES (?, ?, ?, ?)";
// ejecutar cunsulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $_SESSION['usuario_id'], $laboratorio_id, $fecha, $hora);
    $resultado = $stmt->execute();
// si la interacion fue exitosa
    if ($resultado) {
        echo "Reserva realizada con éxito.";
        header("Location: ../public/index.php");
        exit();
    } else {
        echo "Error al guardar la reserva.";
        exit();
    }
}
?>