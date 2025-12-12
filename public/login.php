<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - LabBooker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="logo">LabBooker</a>
        </nav>
    </header>

    <main>
        <div class="card" style="max-width: 400px; margin: 40px auto;">
            <h2>Acceso de Usuarios</h2>
            
            <!-- El formulario envía los datos a AuthController.php -->
            <form action="../controllers/AuthController.php" method="POST">
                
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required placeholder="ejemplo@alumno.edu.uy" value="<?php $_GET['email'] ?? ''; ?>">

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Ingresar</button>
            </form>
            
            <p style="margin-top: 15px; text-align: center;">
                ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
            </p>
        </div>
    </main>
</body>
</html>