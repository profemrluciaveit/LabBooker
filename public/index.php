<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$pdo = Database::getConnection();

$labs = $pdo->query("SELECT * FROM laboratorios")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <title>LabBooker</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>

<h1>Reservas de Laboratorio</h1>

<?php if (!isset($_SESSION["usuario_id"])): ?>

    <p><a href="login.php">Iniciar Sesión</a></p>
    <p><a href="registro.php">Registrarse</a></p>

<?php else: ?>

    <p>Bienvenido, <strong><?php echo $_SESSION["usuario_nombre"]; ?></strong></p>
    <a href="logout.php">Cerrar Sesión</a>

    <h3>Crear una Reserva</h3>

    <form action="../controllers/ReservaController.php" method="POST">
        Laboratorio:
        <select name="laboratorio" required>
            <?php foreach ($labs as $lab): ?>
                <option value="<?= $lab["id"] ?>"><?= $lab["nombre"] ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        Fecha: <input type="date" name="fecha" required><br><br>
        Hora: <input type="time" name="hora" required><br><br>

        <button type="submit">Reservar</button>
    </form>

<?php endif; ?>

</body>
</html>
