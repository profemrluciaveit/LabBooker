<?php
// TAREA: Implementar la lógica para registrar un nuevo usuario en la base de datos.
    require_once __DIR__ . '/../config/db.php'; 

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
   ;
    // TODO: 2. Crea la instancia de conexión.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../registro.php');
        exit;
    }

    $nombre = trim($_POST['nombre'] ?? '');
    $email  = trim($_POST['email']  ?? '');
    $password  = $_POST['password']    ?? '';
    
    if ($nombre === '' || $email === '' || $password === '') {
    header('Location: ../public/registro.php?error=campos_vacios');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../public/registro.php?error=email_invalido');
    exit;
}

$conn = getConnection();


$sqlCheck = "SELECT id FROM usuarios WHERE email = ? LIMIT 1";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param('s', $email);
$stmtCheck->execute();
$resCheck = $stmtCheck->get_result();

if ($resCheck && $resCheck->num_rows > 0) {
    $stmtCheck->close();
    $conn->close();
    header('Location: ../public/registro.php?error=email_ya_existe');
    exit;
}
$stmtCheck->close();

$hash = password_hash($password, PASSWORD_DEFAULT);

$sqlInsert = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sqlInsert);
$stmt->bind_param("sss", $nombre, $email, $password);
$stmt->execute();


$stmt->close();
$conn->close();

if ($ok) {
    header('Location: ../public/login.php?registro=ok');
    exit;
}

header('Location: ../public/registro.php?error=error_db');
exit;

}