<?php
$servidor = "localhost";
$usuario = "root";
$clave_db = "";
$nombre_db = "labbooker";
$conn = new mysqli($servidor, $usuario, $clave_db, $nombre_db);
if ($conn->connect_error) {
die("Conexión fallida: " . $conn->connect_error);
}
$conn->set_charset("utf8");