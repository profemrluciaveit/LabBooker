<?php
class Reserva{

    public $id;
    public $usuario_id;
    public $laboratorio_id;
    public $fecha;
    public $hora;
    
    public function __construct($id, $usuario_id, $laboratorio_id, $fecha, $hora) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->laboratorio_id = $laboratorio_id;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }
}
?>


