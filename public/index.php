<!DOCTYPE html>
<html lang="es">
<head> <link rel="stylesheet" href="styles.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabBooker - Inicio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php

session_start();


require_once __DIR__ . '/../config/db.php';


$conn = null;
$labs = null;
$reservas = null;

if (isset($_SESSION['usuario_id'])) {
    $conn = getConnection();


    $sqlLabs = "SELECT id, nombre FROM laboratorios";
    $labs = $conn->query($sqlLabs);

   
    $sqlReservas = "
        SELECT r.fecha, r.hora, l.nombre AS laboratorio
        FROM reservas r
        JOIN laboratorios l ON r.laboratorio_id = l.id
        WHERE r.usuario_id = ?
        ORDER BY r.fecha DESC, r.hora DESC
    ";
    $stmt = $conn->prepare($sqlReservas);
    $stmt->bind_param("i", $_SESSION['usuario_id']);
    $stmt->execute();
    $reservas = $stmt->get_result();
}
?>
    <header>
        <nav>
            <a href="index.php" class="logo">LabBooker</a>
            <div class="nav-links">
                <!-- TODO: Si existe $_SESSION['usuario_id'], muestra 'Cerrar Sesión' -->
                <!-- De lo contrario, muestra Login y Registro -->

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <form action="logout.php" method="POST" style="display:inline;">
                        <button type="submit" class="btn-secondary">Cerrar Sesión</button>
                    </form>
                <?php else: ?>
                    <a href="login.php">Iniciar Sesión</a>
                    <a href="registro.php">Registrarse</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <section class="card">
            <h1>Bienvenido al Sistema de Reservas</h1>
            <p>Utiliza este sistema para reservar tu turno en los laboratorios de informática.</p>
            
            <div class="mensaje">
                <!-- TODO: Aquí debes mostrar el nombre del usuario si está logueado -->

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <p>Hola, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong>. Ya podés reservar.</p>
                <?php else: ?>
                    <p>Por favor, inicia sesión para reservar.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- TODO: Agrega aquí el Formulario de Reserva solo visible para usuarios logueados -->
        <!-- El formulario debe enviar datos a un archivo php que procese la reserva -->

        <?php if (isset($_SESSION['usuario_id'])): ?>
            <section class="card">
                <h2>Reservar laboratorio</h2>

                <form action="../controllers/ReservaController.php" method="POST">
                    <label>Laboratorio</label>
                    <select name="laboratorio_id" required>
                        <option value="">Seleccionar laboratorio</option>
                        <?php if ($labs): ?>
                            <?php while ($lab = $labs->fetch_assoc()): ?>
                                <option value="<?= (int)$lab['id'] ?>">
                                    <?= htmlspecialchars($lab['nombre']) ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>

                    <label>Fecha</label>
                    <input type="date" name="fecha" required>

                    <label>Hora</label>
                    <input type="time" name="hora" required>

                    <button type="submit">Reservar</button>
                </form>
            </section>

            <section class="card">
                <h2>Mis reservas</h2>

                <?php if ($reservas && $reservas->num_rows > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Laboratorio</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($r = $reservas->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($r['laboratorio']) ?></td>
                                    <td><?= htmlspecialchars($r['fecha']) ?></td>
                                    <td><?= htmlspecialchars($r['hora']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No tenés reservas aún.</p>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php
        // Cierre de recursos si se abrieron
        if (isset($stmt)) { $stmt->close(); }
        if ($conn) { $conn->close(); }
        ?>
    </main>
</body>
</html>

