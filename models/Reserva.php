<?php
// models/Reserva.php
class Reserva {
    public $id;
    public $usuario_id;
    public $laboratorio_id;
    public $fecha;    // YYYY-MM-DD
    public $hora;     // HH:MM:SS or HH:MM
    public $created_at;

    public function __construct(array $data = []) {
        foreach ($data as $k => $v) {
            if (property_exists($this, $k)) $this->$k = $v;
        }
    }
}
