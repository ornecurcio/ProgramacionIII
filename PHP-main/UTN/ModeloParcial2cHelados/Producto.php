<?php

include_once "Toolkit.php";
include_once "GuardarLeerJson.php";


class Producto
{
    public $_id;
    public $_sabor;
    public $_tipo;
    public $_precio;
    public $_stock;
    public $_file;
    private $_nombreCarpeta;
    
    public function __construct($id, $sabor, $tipo, $precio, $stock)
    {
        $this->setId($id);
        $this->setSabor($sabor);
        $this->setTipo($tipo);
        $this->setPrecio($precio);
        $this->setStock($stock);
        $this->_nombreCarpeta = 'ImagenesDeHelado';   // OJO
    }
    public function setId($id)
    {
        if (!empty($id) && is_numeric($id)) 
        {
            $this->_id = $id;
        }
    }
    public function setSabor($sabor)
    {
        if (!empty($sabor)) 
        {
            $this->_sabor = $sabor;
        }
    }

    public function setTipo($tipo)
    {
        if (!empty($tipo)) 
        {
            $this->_tipo = $tipo;
        }
    }

    public function setStock($stock)
    {
        if (!empty($stock) && is_numeric($stock)) 
        {
            $this->_stock = $stock;
        }
    }

    public function setPrecio($precio)
    {
        if (!empty($precio) && is_numeric($precio)) 
        {
            $this->_precio = $precio;
        }
    }

    public function Equals($itemUno, $itemDos)
    {
        $retorno = false;

        $nombreItemUno = Toolkit::SacarValorDeClave($itemUno, "_sabor"); //OJO
        $nombreItemDos = Toolkit::SacarValorDeClave($itemDos, "_sabor"); //OJO
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
            $nuevoStock = Toolkit::SacarValorDeClave($array[$indice], "_stock") +$item->_stock;
            $replace = array("_precio" => $item->_precio, "_stock" => $nuevoStock);
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
                $nuevoStock = Toolkit::SacarValorDeClave($array[$i], "_stock") - $valor;
                $replace = array("_stock" => $nuevoStock);
                $array[$i] = array_replace($array[$i], $replace);
                break;
            }
        }    
        GuardarLeerJson::GrabarEnJson($array, $ruta);
    }

    public function GuardarImagen()
    {     
        $nombreFoto = $this->_sabor."_".$this->_tipo.".jpg";
        $destino = ".".DIRECTORY_SEPARATOR.$this->_nombreCarpeta.DIRECTORY_SEPARATOR;

        if(!file_exists($destino))
        {
            mkdir($destino, 0777, true);
        }

        $dir = $destino.$nombreFoto;
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $dir);
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

        $cantidadExistente = Toolkit::SacarValorDeClave($producto, "_stock");

        if($cantidadExistente >= $cantidadPedida)
        {
            $retorno = true;
        }
        return $retorno;
    }
}

?>