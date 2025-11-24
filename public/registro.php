<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - LabBooker</title>
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
            <h2>Crear Cuenta</h2>
            <form action="#" method="POST">
                <!-- TODO: Conecta este formulario a un controlador para guardar el usuario -->
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Registrarse</button>
            </form>
        </div>
    </main>
</body>
</html>