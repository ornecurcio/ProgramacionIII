<?php
class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    function __construct($marca, $color, $precio = 0, $fecha = null)
    {
        if(is_string($color))
        {
            $this->_color = $color;
        }
        if(is_numeric($precio))
        {
            $this->_precio = $precio;
        } 
        if(is_string($marca))
        {
            $this->_marca = $marca;
        }
        if($fecha!= NULL)
        {
            $this->_fecha = $fecha;
        }
        
    } 
    public function AgregarImpuestos($imp)
    {
        if(is_numeric($imp))
        {
            $this->_precio += $imp;
        }
    }
    public static function MostrarAuto(Auto $auto)
    {
        return  "Color: " .  $auto->_color . ", Precio: ". $auto->_precio . ", Marca: "
        .  $auto->_marca . ", Fecha: " .  $auto->_fecha . "<br>" ;
    }
    public function Equals($auto2)
    {
        return $this->_marca == $auto2->_marca;
    }
    public static function Add($auto1,$auto2)
    {
        if($auto1->Equals($auto2) && $auto1->_color == $auto2->_color)
        {            
            return $auto1->_precio + $auto2->_precio;
        }
        return 0;
    }
}
?>


