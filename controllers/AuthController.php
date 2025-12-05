<?php
// TAREA: Completa la lógica de este archivo para que el login funcione
// TODO: 1. Incluye aquí el archivo de conexión a la base de datos (ej: require_once '../config/db.php')

require_once '../config/db.php';


// Verificamos si la solicitud viene por el método POST

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $email_recibido = $_POST['email'];
    $password_recibido = $_POST['password'];

    echo "Procesando login para: " . $email_recibido . "<br>";

    echo "Datos recibidos en el servidor:<br>";
echo "email: " . htmlspecialchars($email_recibido) . "<br>";
echo "password: " . htmlspecialchars($password_recibida) . "<br>";

} else {
echo "Acceso no permitido.";
}
// TODO: 2. Crea la instancia de la conexión a la base de datos.

$servidor = "localhost";
$usuario_db = "admin";
$clave_db = "";
$nombre_db = "LabBooker";

   $conn = new mysqli($servidor, $usuario_db, $clave_db, $nombre_db, 3308);

if ($conn->connect_error) {

die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");

    // TODO: 3. Escribe la consulta SQL para buscar al usuario que tenga ese email.
    // $sql = "SELECT * FROM ... WHERE ...";


$sql = "SELECT email FROM usuarios";
$resultado = $conn->query($sql);
if ($resultado->num_rows > 0) {
echo "<ul>";

    while($fila = $resultado->fetch_assoc()) {
echo "<li>ID: " . $fila["id"]. " - Nombre: " . $fila["nombre"]. " - $email: $" . $fila["pasword"].
"</li>";
}
echo "</ul>";
} else {
echo "No se encontraron productos.";
}

$conn->close(); 
     
session_start();
require 'db.php';

$email_form = $_POST['email'];
$clave_form = $_POST['password'];

$stmt = $conn->prepare("SELECT id, email, pass_hash FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email_form);

$stmt->execute();
$resultado = $stmt->get_result();

    // TODO: 5. Verifica si el usuario existe y si la contraseña coincide.
    // Pista: Compara $password_recibido con la contraseña que vino de la base de datos.

    /* TODO: 6. Si las credenciales son correctas:
       - Inicia la sesión con session_start().
       - Guarda el ID y el Nombre del usuario en $_SESSION.
       - Redirige al usuario a '../public/index.php'.
    */

    /*
       TODO: 7. Si las credenciales son incorrectas:
       - Muestra un mensaje de error o redirige al login.
    */
    
    echo "ERROR: La lógica de conexión y validación aún no ha sido implementada por el alumno.";

?>