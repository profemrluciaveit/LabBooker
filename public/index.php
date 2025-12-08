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
            
            <div class="mensaje">
                <!-- TODO: Aquí debes mostrar el nombre del usuario si está logueado -->
                <p>Por favor, inicia sesión para reservar.</p>
            </div>
        </section>
<!-- FORMULARIO DE RESERVA (solo visible si hay sesión) -->
        <?php if (isset($_SESSION['usuario_id'])): ?>
        <section class="card">
            <h2>Realizar una Reserva</h2>

            <form action="../controllers/ReservaController.php" method="POST">

                <label for="laboratorio">Laboratorio:</label>
                <select name="laboratorio" id="laboratorio" required>
                    <option value="">Seleccionar...</option>
                    <option value="1">Laboratorio 1</option>
                    <option value="2">Laboratorio 2</option>
                    <option value="3">Laboratorio 3</option>
                </select>

                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha" required>

                <label for="hora">Hora:</label>
                <input type="time" name="hora" id="hora" required>

                <button type="submit">Reservar</button>
            </form>
        </section>
        <?php endif; ?>
        <!-- TODO: Agrega aquí el Formulario de Reserva solo visible para usuarios logueados -->
        <!-- El formulario debe enviar datos a un archivo php que procese la reserva -->
    </main>
</body>
</html>