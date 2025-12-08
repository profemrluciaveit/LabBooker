<?php


function getConnection(): mysqli {
    $servidor   = "localhost";
    $usuario_db = "root";        
    $clave_db   = "";              
    $nombre_db  = "labbooker_db";  
    $conn = new mysqli($servidor, $usuario_db, $clave_db, $nombre_db);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4"); 

    return $conn;
}
