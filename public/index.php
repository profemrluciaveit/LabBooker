<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabBooker - Inicio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    require_once 'validar.php';
    ?>
    <header>
        <nav>
            <a href="index.php" class="logo">LabBooker</a>
            <div class="nav-links">
                <?php
                // TODO: Si existe $_SESSION['usuario_id'], muestra 'Cerrar Sesión'
                if (isset($_SESSION['id'])) {
                    echo "<a href='index.php?logout=1'>Cerrar Sesión</a>";
                } else {
                    // De lo contrario, muestra Login y Registro
                    echo "<a href='login.php'>Iniciar Sesión</a>";
                    echo "<a href='registro.php'>Registrarse</a>";
                }
                ?>
            </div>
        </nav>
    </header>

    <main>
        <section class="card">
            <h1>Bienvenido al Sistema de Reservas</h1>
            <p>Utiliza este sistema para reservar tu turno en los laboratorios de informática.</p>
            
            <div class="mensaje">
                <?php
                // TODO: Aquí debes mostrar el nombre del usuario si está logueado
                if (isset($_SESSION['id'])) {
                    echo "<p>Hola, " . $_SESSION['nombre'] . "! Realiza tu reserva a continuación.</p>";
                } else {
                    echo "<p>Por favor, inicia sesión para reservar.</p>";
                }
                ?>
            </div>
        </section>
        <!-- TODO: Agrega aquí el Formulario de Reserva solo visible para usuarios logueados -->
        <!-- El formulario debe enviar datos a un archivo php que procese la reserva -->
        <?php
        if (isset($_SESSION['id'])) {
        ?>
        <section class="card" style="max-width: 500px; margin: 30px auto;">
            <h2>Hacer una Reserva</h2>
            <form action="../controllers/ReservaController.php" method="POST">
                
                <label for="laboratorio_id">Laboratorio</label>
                <select id="laboratorio_id" name="laboratorio_id" required>
                    <option value="">Selecciona un laboratorio</option>
                    <option value="1">Laboratorio 1 (Programación)</option>
                    <option value="2">Laboratorio 2 (Sistemas Op.)</option>
                    <option value="3">Laboratorio 3 (Redes)</option>
                </select>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d'); ?>" required>

                <label for="hora">Hora</label>
                <input type="time" id="hora" name="hora" required>

                <button type="submit">Reservar</button>
            </form>
        </section>
        <?php
        }
        ?>
    </main>
</body>
</html>