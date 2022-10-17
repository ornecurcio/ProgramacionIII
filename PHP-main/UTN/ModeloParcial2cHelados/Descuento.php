<?php

class Descuento{

    public int $_idPedido;
    public int $_id;
    public float $_porcentajeDescuento;
    public bool $_usado;

    public function __construct($id,$idPedido,$porcentajeDescuento,$usado)
    { 
        $this->_id = $id;   
        $this->_idPedido = $idPedido;   
        $this->_porcentajeDescuento = $porcentajeDescuento; 
        $this->_usado = $usado;
    }
}

?>