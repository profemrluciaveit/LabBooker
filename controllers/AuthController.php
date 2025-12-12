<?php
// TAREA: Completa la lógica de este archivo para que el login funcione
// TODO: 1. Incluye aquí el archivo de conexión a la base de datos (ej: require_once '../config/db.php')

session_start();
require_once '../config/db.php';

// Verificamos si la solicitud viene por el método POST

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email_recibido = $_POST['email'];
    $password_recibido = $_POST['password'];

    echo "Procesando login para: " . htmlspecialchars($email_recibido) . "<br>";
    echo "email: " . htmlspecialchars($email_recibido) . "<br>";
    echo "password: " . htmlspecialchars($password_recibido) . "<br>";

} else {
    echo "Acceso no permitido.";
    exit;
}

// TODO: 2. Crear la instancia de conexión a la base de datos

$servidor = "localhost";
$usuario_db = "root";
$clave_db = "";
$nombre_db = "LabBooker";

$conn = new mysqli($servidor, $usuario_db, $clave_db, $nombre_db, 3308);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");

// TODO: 3. Buscar al usuario por su email usando lo enseñado en el repaso

$sql = "SELECT id, nombre, email, password FROM usuarios WHERE email = '$email_recibido'";
$resultado = $conn->query($sql);

// TODO 5: Verificar si el usuario existe y si la contraseña coincide
// Pista: Compara $password_recibido con la contraseña que vino de la base de datos.

if ($resultado->num_rows === 1) {
    $usuarios = $resultado->fetch_assoc();
} else {
    echo"Usuario no encontrado";
    exit;

}

if ($password_recibido !== $usuarios['password']) {
    echo "<script>
        if (confirm('Datos incorrectos')) {
            window.location.href = '../public/login.php';
        }
    </script>";
    exit;
}

/* TODO: 6. Si las credenciales son correctas:
       - Inicia la sesión con session_start().
       - Guarda el ID y el Nombre del usuario en $_SESSION.
       - Redirige al usuario a '../public/index.php'.
*/
$_SESSION['usuario_id'] = $usuarios['id'];
$_SESSION['usuario_nombre'] = $usuarios['nombre'];

 /*
       TODO: 7. Si las credenciales son incorrectas:
       - Muestra un mensaje de error o redirige al login.
*/
header("Location: ../public/index.php");
exit;

 
?>