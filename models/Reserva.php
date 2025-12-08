<?php

class Reserva {

    private $id;
    private $usuario_id;
    private $laboratorio_id;
    private $fecha;
    private $hora;

    public function __construct($id, $usuario_id, $laboratorio_id, $fecha, $hora) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->laboratorio_id = $laboratorio_id;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }

    public function getId() { return $this->id; }
    public function getUsuarioId() { return $this->usuario_id; }
    public function getLaboratorioId() { return $this->laboratorio_id; }
    public function getFecha() { return $this->fecha; }
    public function getHora() { return $this->hora; }
}
?>
