<?php

class Devolucion
{
    public int $id;
    public int $numeroDePedido;
    public string $mailUsuario;
    public string $nombre;
    public string $tipo;
    public int $cantidad;
    public string $fechaDePedido;

    public function __construct($id,$mailUsuario,$nombre,$tipo,$cantidad, $numeroDePedido,$fechaDePedido="", $causa)
    { 
        $this->id = $id;   
        $this->mailUsuario = $mailUsuario;   
        $this->nombre = $nombre; 
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;    
        $this->fechaDePedido = $fechaDePedido;   
        $this->numeroDePedido = $numeroDePedido;
        $this->causa = $causa; 
    }

    public function Mostrar()
    {
        echo "$this->numeroDePedido,$this->id,$this->mailUsuario,$this->nombre, $this->tipo,$this->cantidad,$this->fechaDePedido";
    }
}

?>