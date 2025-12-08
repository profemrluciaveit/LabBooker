<?php
// TAREA: Completa la lógica de este archivo para que el login funcione.

// TODO: 1. Incluye aquí el archivo de conexión a la base de datos (ej: require_once '../config/db.php')
require_once '../models/Usuario.php';
require_once '../config/db.php';

// Verificamos si la solicitud viene por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibimos los datos del formulario
    $email_recibido = $_POST['email'];
    $password_recibido = $_POST['password'];

    echo "Procesando login para: " . $email_recibido . "<br>";

    // TODO: 2. Crea la instancia de la conexión a la base de datos.


    // TODO: 3. Escribe la consulta SQL para buscar al usuario que tenga ese email.
    
    $sql = "SELECT id, nombre, email, pass_hash FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    // $sql = "SELECT * FROM ... WHERE ...";

    // TODO: 4. Ejecuta la consulta y obtén el resultado.
   $stmt->bind_param("s", $email_recibido);
   $stmt->execute();
   $resultado = $stmt->get_result();

    // TODO: 5. Verifica si el usuario existe y si la contraseña coincide.
    // Pista: Compara $password_recibido con la contraseña que vino de la base de datos.

   if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($password_recibido, $usuario["pass_hash"])) {
        session_start();
        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_nombre"] = $usuario["nombre"];

        header("Location: ../public/index.php");
        exit();
    } else {
        echo "Contraseña incorrecta";
        exit();
    }
} else {
    echo "Usuario no encontrado";
    exit();
}


    /* TODO: 6. Si las credenciales son correctas:
       - Inicia la sesión con session_start().
       - Guarda el ID y el Nombre del usuario en $_SESSION.
       - Redirige al usuario a '../public/index.php'.
    */
   session_start();
   $_SESSION["usuario_id"] = $usuario["id"];
   $_SESSION["usuario_nombre"] = $usuario["nombre"];
   header("Location: ../public/index.php");
exit();

    /*
       TODO: 7. Si las credenciales son incorrectas:
       - Muestra un mensaje de error o redirige al login.
    */
    
    echo "ERROR: La lógica de conexión y validación aún no ha sido implementada por el alumno.";
}
exit();
?>