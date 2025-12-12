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
    header('Location: ../public/registro.php?error=campos_vacios');       
     exit();
    }


   
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../public/registro.php?error=email_invalido');
    exit;
}

$conn = getConnection();


$sqlCheck = "SELECT id FROM usuarios WHERE email = ? LIMIT 1";
$stmtCheck = $conn->prepare($sqlCheck);

if (!$stmtCheck) {
        $conn->close();
        header('Location: ../public/registro.php?error=error_db');
        exit;
    }

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


 $sqlInsert = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sqlInsert);

    if (!$stmt) {
        $conn->close();
        header('Location: ../public/registro.php?error=error_db');
        exit;
    }

    $stmt->bind_param("sss", $nombre, $email, $password);

    $ok = $stmt->execute();

    $stmt->close();
    $conn->close();

    if ($ok) {
        header('Location: ../public/login.php?registro=ok');
        exit;
    } else {
        header('Location: ../public/registro.php?error=error_db');
        exit;
    }
}