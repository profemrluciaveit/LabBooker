<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $laboratorio = $_POST['lab'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $id_usuario = $_SESSION['usuario_id'];

} else {
    echo "Acceso no permitido.";
    exit;
}

$servidor = "localhost";
$usuario_db = "root";
$clave_db = "";
$nombre_db = "LabBooker";

$conn = new mysqli($servidor, $usuario_db, $clave_db, $nombre_db,3308 );
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$conn->set_charset("utf8");

$sql = "INSERT INTO reservas (usuario_id, laboratorio_id, fecha, hora) VALUES ('$id_usuario', '$laboratorio', '$fecha', '$hora')";
$resultado = $conn->query($sql);

if ($resultado === true) {
    header("Location: ../public/index.php");
    exit;
} else {
    echo "<script>
        if (confirm('Error al realizar la reserva')) {
            window.location.href = '../public/index.php';
        }
        </script>";
    exit;
}