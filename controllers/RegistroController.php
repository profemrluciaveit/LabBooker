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
    // TODO: 3. Escribe la consulta SQL para INSERTAR el usuario en la tabla 'usuarios'.
    // $sql = "INSERT INTO ...";
    
    /* NOTA: Para este ejercicio básico, puedes guardar la contraseña tal cual viene (texto plano).
       Si quieres un desafío extra, investiga la función password_hash() de PHP.
    */

    // TODO: 4. Ejecuta la consulta.

    /* TODO: 5. Si la inserción fue exitosa:
       - Redirige al usuario a la página de login (header("Location: ../public/login.php")).
       
       Si falló:
       - Muestra un mensaje de error.
    */

    echo "ERROR: La lógica de registro aún no ha sido implementada por el alumno.";

} else {
    // Si intentan entrar a este archivo sin enviar el formulario
    header("Location: ../public/registro.php");
    exit();
}
?>