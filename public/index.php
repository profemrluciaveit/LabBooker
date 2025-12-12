<?php

session_start();

if (isset($_SESSION['usuario_id'])) {
    $usuario_nombre = $_SESSION['usuario_nombre'];
    $usuario_id = $_SESSION['usuario_id'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabBooker - Inicio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="logo">LabBooker</a>
            <div class="nav-links">
                <!-- TODO: Si existe $_SESSION['usuario_id'], muestra 'Cerrar Sesión' -->
                <!-- De lo contrario, muestra Login y Registro -->
                <a href="login.php">Iniciar Sesión</a>
                <a href="registro.php">Registrarse</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="card">
            <h1>Bienvenido al Sistema de Reservas</h1>
            <p>Utiliza este sistema para reservar tu turno en los laboratorios de informática.</p>
          <?php if (!isset($usuario_nombre)) { ?>  
            <div class="mensaje">
                <!-- TODO: Aquí debes mostrar el nombre del usuario si está logueado -->
                <p>Por favor, inicia sesión para reservar.</p>
            </div>
            <?php } ?>
        </section>

            <?php if (isset($usuario_nombre)) { ?>

        <section class="card">
            <form action="../controllers/ReservaController.php" method="POST">

                <label for="lab">Laboratorio</label>
                <select name="lab" id="lab">
                    <option value="1">Laboratorio 1 (Programación)</option>
                    <option value="2">Laboratorio 2 (Sistemas op.)</option>
                    <option value="3">Laboratorio 3 (Redes)</option>
                </select>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" min="<?= date('Y-m-d'); ?>" name="fecha" required>

                <label for="hora">Hora</label>
                <input type="time" id="hora" name="hora" required>

                <button type="submit">Reservar</button>
            
            </form>

            
        </section>
        <form action="cerrarSesion.php" method="POST">
            <button type="submit">Cerrar sesión</button>
        </form>
        
        <?php } ?>

        <!-- TODO: Agrega aquí el Formulario de Reserva solo visible para usuarios logueados -->
        <!-- El formulario debe enviar datos a un archivo php que procese la reserva -->
    </main>
</body>
</html>