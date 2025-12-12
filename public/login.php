<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
  <link rel="stylesheet" href="style.css">

</head>
<a href="index.php">volver</a></p>
<body>


<h2>Iniciar Sesión</h2>

<form action="../controllers/AuthController.php" method="POST">
    Email: <input type="email" name="email" required><br><br>
    Contraseña: <input type="password" name="password" required><br><br>
    <button type="submit">Entrar</button>
</form>

<p>¿No tienes cuenta? <a href="registro.php">Registrarse</a></p>

</body>
</html>
