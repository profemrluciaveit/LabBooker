<?php
// TAREA: Completa la lógica de este archivo para que el login funcione.

// TODO: 1. Incluye aquí el archivo de conexión a la base de datos (ej: require_once '../config/db.php')
require_once '/../config/db.php';

// Verificamos si la solicitud viene por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibimos los datos del formulario
    $email_recibido = $_POST['email'];
    $password_recibido = $_POST['password'];

    echo "Procesando login para: " . $email_recibido . "<br>";

    // TODO: 2. Crea la instancia de la conexión a la base de datos.
    
    // TODO: 3. Escribe la consulta SQL para buscar al usuario que tenga ese email.
    // $sql = "SELECT * FROM ... WHERE ...";

    // TODO: 4. Ejecuta la consulta y obtén el resultado.

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
}
?>