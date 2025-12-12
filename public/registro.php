<!DOCTYPE html>
<html>
<head>
<title>Registro</title>
  <link rel="stylesheet" href="style.css">
</head>
<a href="index.php">volver</a></p>

<body>

<h2>Crear Cuenta</h2>

<form action="../controllers/RegistroController.php" method="POST">
    Nombre: <input type="text" name="nombre" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Contraseña: <input type="password" name="password" required><br><br>

    <button type="submit">Registrarse</button>
</form>

<p>¿Ya tienes cuenta? <a href="login.php">Iniciar Sesión</a></p>

</body>
</html>
