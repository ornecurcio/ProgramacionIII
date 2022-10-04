<?php

include_once "Toolkit.php";
include_once "GuardarLeerJson.php";


class Hamburguesa
{
    public $_id;
    public $_nombre;
    public $_tipo;
    public $_precio;
    public $_cantidad;
    public $_file;
    private $_nombreCarpeta;
    
    public function __construct($nombre, $tipo, $precio, $cantidad, $file)
    {
        $this->setNombre($nombre);
        $this->setTipo($tipo);
        $this->setPrecio($precio);
        $this->setCantidad($cantidad);
        $this->setFile($file);
        $this->_nombreCarpeta = 'ImagenesDeHamburguesas';   // OJO
    }
    
    public function setNombre($nombre)
    {
        if (!empty($nombre)) 
        {
            $this->_nombre = $nombre;
        }
    }

    public function setTipo($tipo)
    {
        if (!empty($tipo)) 
        {
            $this->_tipo = $tipo;
        }
    }

    public function setCantidad($cantidad)
    {
        if (!empty($cantidad) && is_numeric($cantidad)) 
        {
            $this->_cantidad = $cantidad;
        }
    }

    public function setPrecio($precio)
    {
        if (!empty($precio) && is_numeric($precio)) 
        {
            $this->_precio = $precio;
        }
    }

    public function setFile($file)
    {
        if(!empty($file) && is_file($file))
        {
            $this->_file = $file;
        }
    }
    public function Equals($itemUno, $itemDos)
    {
        $retorno = false;

        $nombreItemUno = Toolkit::SacarValorDeClave($itemUno, "_nombre");
        $nombreItemDos = Toolkit::SacarValorDeClave($itemDos, "_nombre");
        $tipoItemUno = Toolkit::SacarValorDeClave($itemUno, "_tipo");
        $tipoItemDos = Toolkit::SacarValorDeClave($itemDos, "_tipo");

        if($nombreItemUno != null && $nombreItemDos != null &&
          $tipoItemUno != null &&  $tipoItemDos != null &&
          trim($nombreItemUno) == trim($nombreItemDos) && 
          trim($tipoItemUno) == trim($tipoItemDos))
        {
            $retorno = true;
        }
        return $retorno;
    }

    public static function AltaModificacion($item, $array, $ruta)
    {  
        $indice = Toolkit::ConsultaSiHayYCual($item, $array); 

        if($indice > -1)
        {  
            $nuevoStock = Toolkit::SacarValorDeClave($array[$indice], "_cantidad") +$item->_cantidad;
            $replace = array("_precio" => $item->_precio, "_cantidad" => $nuevoStock);
            $array[$indice] = array_replace($array[$indice], $replace);
        }
        else
        {
            Toolkit::AsignarId($item, $array);
            $archivo = $item->GuardarImagen();
            $item->_file = $archivo;
            array_push($array, $item);
        }
        GuardarLeerJson::GrabarEnJson($array, $ruta);
    }

    public static function RestarStock($idProducto, $array, $ruta, $valor)
    {
        for($i = 0 ; $i < sizeof($array) ; $i++)
        {         
            $idEnArray = Toolkit::SacarValorDeClave($array[$i], "_id");
            if($idEnArray == $idProducto)
            {
                $nuevoStock = Toolkit::SacarValorDeClave($array[$i], "_cantidad") - $valor;
                $replace = array("_cantidad" => $nuevoStock);
                $array[$i] = array_replace($array[$i], $replace);
                break;
            }
        }    
        GuardarLeerJson::GrabarEnJson($array, $ruta);
    }

    public function GuardarImagen()
    {     
        $nombreFoto = $this->_nombre."_".$this->_tipo.".jpg";
        $destino = ".".DIRECTORY_SEPARATOR.$this->_nombreCarpeta.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;

        if(!file_exists($destino))
        {
            mkdir($destino, 0777, true);
        }

        $dir = $destino.$nombreFoto;
        move_uploaded_file($this->_file["tmp_name"], $dir);
        return $dir;
    }

    public static function SaberIdPorTipo($tipo, $array)
    {
        foreach($array as $item)
        {
            $tipoItem = Toolkit::SacarValorDeClave($item, "_tipo");

            if($tipoItem == $tipo)
            {
                $idItem = Toolkit::SacarValorDeClave($item, "_id");
                return $idItem;
            }
        }
    }

    public static function HayStockSuficiente($producto, $cantidadPedida)
    {
        $retorno = false;

        $cantidadExistente = Toolkit::SacarValorDeClave($producto, "_cantidad");

        if($cantidadExistente >= $cantidadPedida)
        {
            $retorno = true;
        }
        return $retorno;
    }
}

?>