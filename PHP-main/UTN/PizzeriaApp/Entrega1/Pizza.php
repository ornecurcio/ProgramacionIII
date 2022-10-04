<?php

include_once "Herramientas.php";
include_once "GuardarLeerJson.php";


class Producto
{
    public $_id;
    public $_sabor;
    public $_tipo;
    public $_precio;
    public $_cantidad;
    
    public function __construct($sabor, $tipo, $precio, $cantidad)
    {
        $this->_sabor = $sabor;
        $this->_tipo = $tipo;
        $this->_precio = $precio;
        $this->_cantidad = $cantidad;
    }

    public function Equals($itemUno, $itemDos)
    {
        $retorno = false;

        $saborItemUno = Herramientas::SacarValorDeClave($itemUno, "_sabor");
        $saborItemDos = Herramientas::SacarValorDeClave($itemDos, "_sabor");
        $tipoItemUno = Herramientas::SacarValorDeClave($itemUno, "_tipo");
        $tipoItemDos = Herramientas::SacarValorDeClave($itemDos, "_tipo");

        if($saborItemUno != null && $saborItemDos != null &&
          $tipoItemUno != null &&  $tipoItemDos != null &&
          trim($saborItemUno) == trim($saborItemDos) && 
          trim($tipoItemUno) == trim($tipoItemDos))
        {
            $retorno = true;
        }
        return $retorno;
    }

    public static function AltaModificacion($item, $array, $ruta)
    {  
        $indice = Herramientas::ConsultaSiHayYCual($item, $array); 

        if($indice > -1)
        {  
            $nuevoStock = Herramientas::SacarValorDeClave($array[$indice], "_cantidad") +$item->_cantidad;
            $replace = array("_precio" => $item->_precio, "_cantidad" => $nuevoStock);
            $array[$indice] = array_replace($array[$indice], $replace);
        }
        else
        {
            Herramientas::AsignarId($item, $array);
            array_push($array, $item);
        }
        GuardarLeerJson::GrabarEnJson($array, $ruta);
    }

}

?>