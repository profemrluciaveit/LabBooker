<?php


class Reserva {
    public int $usuario_id;
    public int $laboratorio_id;
    public string $fecha; 
    public string $hora;  

    public function __construct(int $usuario_id, int $laboratorio_id, string $fecha, string $hora) {
        $this->usuario_id     = $usuario_id;
        $this->laboratorio_id = $laboratorio_id;
        $this->fecha          = $fecha;
        $this->hora           = $hora;
    }

    public function guardar(mysqli $conn): bool {
        $sql = "INSERT INTO reservas (usuario_id, laboratorio_id, fecha, hora)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("iiss",
            $this->usuario_id,
            $this->laboratorio_id,
            $this->fecha,
            $this->hora
        );

        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
