<?php
// TAREA: Completa la lógica de este archivo para que el login funcione.

// TODO: 1. Incluye aquí el archivo de conexión a la base de datos (ej: require_once '../config/db.php')

// Verificamos si la solicitud viene por el método POST
 require_once __DIR__ . '/../config/db.php'; 

  session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email_recibido =trim($_POST['email'] ?? "");
    $password_recibido = $_POST['password'?? ""];

   if ($email_recibido === '' || $password_recibido === '') {
    header('Location: ../public/login.php?error=campos_vacios');
    exit;

    // TODO: 2. Crea la instancia de la conexión a la base de datos.
    $conn = getConnection();
    // TODO: 3. Escribe la consulta SQL para buscar al usuario que tenga ese email.
    // $sql = "SELECT * FROM ... WHERE ...";
$sql  = "SELECT id, nombre, email, password FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
    // TODO: 4. Ejecuta la consulta y obtén el resultado.
if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}
 
  $stmt->bind_param("s", $email_recibido);
      $stmt->execute();
         $result = $stmt->get_result();
    // TODO: 5. Verifica si el usuario existe y si la contraseña coincide.
    // Pista: Compara $password_recibido con la contraseña que vino de la base de datos.
if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
    /* TODO: 6. Si las credenciales son correctas:
       - Inicia la sesión con session_start().
       - Guarda el ID y el Nombre del usuario en $_SESSION.
       - Redirige al usuario a '../public/index.php'.
    */
}if ($password_recibido === $usuario['password']) { // FIX: texto plano
   
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nombre'] = $usuario['nombre'];
    header('Location: ../public/index.php');
    exit;
} else {
    header('Location: ../public/login.php?error=clave_incorrecta');
    exit;
}

$stmt->close();
$conn->close();

    /*
       TODO: 7. Si las credenciales son incorrectas:
       - Muestra un mensaje de error o redirige al login.
    */
    
    echo "ERROR: La lógica de conexión y validación aún no ha sido implementada por el alumno.";

    ?>