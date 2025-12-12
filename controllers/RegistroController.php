<?php
// TAREA: Implementar la lógica para registrar un nuevo usuario en la base de datos.
session_start();
require_once '../config/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];


if (empty($nombre) || empty($email) || empty($password)) {
        echo "Error: Todos los campos son obligatorios.";
        exit();
    }

    // TODO: 1. Incluye el archivo de conexión a la base de datos.
    // require_once ...

    // TODO: 2. Crea la instancia de conexión.

$servidor = "localhost";
$usuario_db = "root";
$clave_db = "";
$nombre_db = "LabBooker";

$conn = new mysqli($servidor, $usuario_db, $clave_db, $nombre_db, 3308);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");

    // TODO: 3. Escribe la consulta SQL para INSERTAR el usuario en la tabla 'usuarios'.
    // $sql = "INSERT INTO ...";

    $sql = "INSERT INTO usuarios (email, password, nombre) VALUES ('$email', '$password', '$nombre')";
    $resultado = $conn->query($sql);
   
    // TODO: 4. Ejecuta la consulta.

    /* TODO: 5. Si la inserción fue exitosa:
       - Redirige al usuario a la página de login  header("Location: ../public/registro.php");).
    
       Si falló:
       - Muestra un mensaje de error.
    */
if ($resultado === true) {
  header("Location: ../public/login.php");

}else{

       echo "<script>
        if (confirm('Error')) {
            window.location.href = '../public/registro.php';
        }
    </script>";
    exit;
}


} else {
    // Si intentan entrar a este archivo sin enviar el formulario
    header("Location: ../public/registro.php");
    exit();
}
?>