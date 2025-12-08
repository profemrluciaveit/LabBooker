<?php
// TAREA: Implementar la lógica para registrar un nuevo usuario en la base de datos.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibimos los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validacion básica (Backend)
    if (empty($nombre) || empty($email) || empty($password)) {
        echo "Error: Todos los campos son obligatorios.";
        exit();
    }

    // TODO: 1. Incluye el archivo de conexión a la base de datos.
    // require_once ...
    require_once __DIR__ . '/../config/db.php';
    // TODO: 2. Crea la instancia de conexión.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../registro.php');
        exit;
    }

    $nombre = trim($_POST['nombre'] ?? '');
    $email  = trim($_POST['email']  ?? '');
    $clave  = $_POST['password']    ?? '';
    
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../login.php?error=debe_loguearse');
        exit;
    }
    $usuarioId     = (int) $_SESSION['usuario_id'];
    $laboratorioId = (int) ($_POST['laboratorio_id'] ?? 0);
    $fecha         = trim($_POST['fecha'] ?? '');
    $hora          = trim($_POST['hora']  ?? '');$usuarioId     = (int) $_SESSION['usuario_id'];
    $laboratorioId = (int) ($_POST['laboratorio_id'] ?? 0);
    $fecha         = trim($_POST['fecha'] ?? '');
    $hora          = trim($_POST['hora']  ?? '');
    echo "ERROR: La lógica de registro aún no ha sido implementada por el alumno.";
    
    if ($laboratorioId === 0 || $fecha === '' || $hora === '') {
        header('Location: ../index.php?error=campos_vacios');
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
    // Si intentan entrar a este archivo sin enviar el formulario
}else{
    header("Location: ../public/registro.php");
    exit();
    
}
?>