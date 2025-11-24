<?php
// Clase Usuario: Representa a la entidad usuario de la base de datos
class Usuario {
    // Atributos privados para el encapsulamiento
    private $id;
    private $nombre;
    private $email;
    private $password;

    public function __construct($id, $nombre, $email, $password) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
    }

    // Métodos Getters para acceder a los datos
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
}
?>