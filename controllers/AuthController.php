<?php
// TAREA: Completa la lógica de este archivo para que el login funcione.

// TODO: 1. Incluye aquí el archivo de conexión a la base de datos (ej: require_once '../config/db.php')
session_start();
require_once '../models/Usuario.php';
require_once '../config/db.php';

// Verificamos si la solicitud viene por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibimos los datos del formulario
    $email_recibido = $_POST['email'];
    $password_recibido = $_POST['password'];

    echo "Procesando login para: " . $email_recibido . "<br>";

    // TODO: 2. Crea la instancia de la conexión a la base de datos.
    $conn = new mysqli($servidor, $usuario_db, $clave_db, $nombre_db);
    
    // TODO: 3. Escribe la consulta SQL para buscar al usuario que tenga ese email.
    // $sql = "SELECT * FROM ... WHERE ...";

    $sql = "SELECT * FROM usuarios WHERE email = '" . $email_recibido . "'";

    // TODO: 4. Ejecuta la consulta y obtén el resultado.
   $resultado = $conn->query($sql);

    // TODO: 5. Verifica si el usuario existe y si la contraseña coincide.
    // Pista: Compara $password_recibido con la contraseña que vino de la base de datos.
    if ($resultado && $resultado->num_rows > 0) {
        $usuario_datos = $resultado->fetch_assoc();
        if ($password_recibido == $usuario_datos['password']) {

    /* TODO: 6. Si las credenciales son correctas:
       - Inicia la sesión con session_start().
       - Guarda el ID y el Nombre del usuario en $_SESSION.
       - Redirige al usuario a '../public/index.php'.
    */
$_SESSION['nombre'] = $usuario_datos['nombre'];
$_SESSION['id'] = $usuario_datos['id'];

    header("Location: ../public/index.php");
exit;

    /*
       TODO: 7. Si las credenciales son incorrectas:
       - Muestra un mensaje de error o redirige al login.
    */
        } else {
            echo "Usuario o clave incorrectos.";
        }
    } else {
        echo "Usuario o clave incorrectos.";
    }

} else {
echo "Usuario o clave incorrectos.";
}
?>