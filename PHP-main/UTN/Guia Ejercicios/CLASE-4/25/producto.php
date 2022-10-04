/*
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un
objeto y utilizar sus métodos para poder verificar si es un producto existente, si ya existe
el producto se le suma el stock , de lo contrario se agrega al documento en un nuevo
renglón
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase
*/
<?php
class Producto
{

    public $_id;
    public $_codigo;
    public $_nombre;
    public $_tipo;
    public $_stock;
    public $_precio;

    public function __construct($id, $codigo, $nombre, $tipo, $stock, $precio)
    {
        $this->setId($id);
        $this->setCodigo($codigo);
        $this->setNombre($nombre);
        $this->setTipo($tipo);
        $this->setStock($stock);
        $this->setPrecio($precio);
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getCodigo()
    {
        return $this->_codigo;
    }

    public function getNombre()
    {
        return $this->_nombre;
    }

    public function getTipo()
    {
        return $this->_tipo;
    }

    public function getStock()
    {
        return $this->_stock;
    }

    public function getPrecio()
    {
        return $this->_precio;
    }

    public function setId($id)
    {
        if (is_int($id)) 
        {
            $this->_id = $id;
        }
    }

    public function setCodigo($codigo)
    {
        if (!empty($codigo) && is_string($codigo) && strlen($codigo) == 6)
        {
            $this->_codigo = $codigo;
        }
    }

    public function setNombre($nombre)
    {
        if (!empty($nombre)) 
        {
            $this->_nombre = $nombre;
        }
    }

    public function settipo($tipo)
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

    public function __Equals($obj):bool
    {
        if (get_class($obj) == "Producto" && $obj->getId() == $this->getId() && $obj->getCodigo() == $this->getCodigo()) 
        {
            return true;
        }
        return false;
    }

    public function ProductosEnArray($arrayProductos):bool
    {
        foreach ($arrayProductos as $producto)
        {
            if ($this->__Equals($producto)) 
            {
                return true;
            }
        }
        return false;
    }

    public static function ActualizarArray($arrayProductos, $producto):array
    {
        
        if (!$producto->ProductosEnArray($arrayProductos)) 
        {
            array_push($arrayProductos, $producto);
            echo "Producto no existente, agregado.";
        }
        else
        {
            foreach ($arrayProductos as $aProducto) 
            {
                if ($aProducto->__Equals($producto)) 
                {
                    $aProducto->setStock("".$aProducto->getStock() + $producto->getStock()."");
                    echo "Producto actualizado.";
                    break;
                }
            }
        }
        return $arrayOfProducts;
    }

    public static function LeerJSON($ruta="Productos.json"):array
    {
        $productos = array();
        try 
        {
            if (file_exists($filename)) 
            {                  
                $file = fopen($filename, "r");
                if ($file) 
                {
                    $json = fread($file, filesize($filename));
                    $productosDesdeJson = json_decode($json, true);
                    foreach ($productosDesdeJson as $producto) 
                    {
                        array_push($productos, new Product($producto["_id"], $producto["_codigo"], $producto["_nombre"], $producto["_tipo"], $producto["_stock"], $producto["_precio"]));
                    }
                }
                fclose($file);
            } 
        }
        catch (\Throwable $th) 
        {
            echo "Error al leer archivo";
        } 
        finally 
        {
            return $productos;
        }
    }

    public static function EscribirEnJSON($productosArray, $filename="Productos.json"):bool
    {
        $retorno = false;
        try 
        {
            $file = fopen($filename, "w");
            if ($file) {
                //var_dump($productsArray);
                $json = json_encode($productosArray, JSON_PRETTY_PRINT);
                //echo $json . '<br>';
                fwrite($file, $json);
                $retorno = true;
            }
        } 
        catch (\Throwable $th) 
        {
            echo "Error al guardar el archivo";
        } 
        finally 
        {
            fclose($file);
            return $retorno;
        }
    }
}
?>