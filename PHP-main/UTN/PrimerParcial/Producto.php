<?php

class Producto
{
    public string $nombre;
    public float $precio;
    public string $tipo;
    public int $stock;

    public function __construct($id,$nombre,$precio,$tipo,$stock)
    { 
        $this->id = $id;      
        $this->nombre = $nombre; 
        $this->precio = $precio;
        $this->tipo = $tipo; 
        $this->stock = $stock;
    }

    public function GuardarImagen()
    {  
        $nombreDeArchivo = "$this->tipo - $this->nombre";

        if(!file_exists(".".DIRECTORY_SEPARATOR."ImagenesDeHamburguesas".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR))
        {
            mkdir(".".DIRECTORY_SEPARATOR."ImagenesDeHamburguesas".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, 0777, true);
        }
        $destino = "ImagenesDeHamburguesas/" . $nombreDeArchivo . ".jpg";
        $tmpName = $_FILES["archivo"]["tmp_name"];

        if (move_uploaded_file($tmpName, $destino)) 
        {
            echo "La foto se guardó correctamente\n";
            return true;
        } else 
        {
           echo "La foto no pudo guardarse";
           return false;
        }
    }
    public function Mostrar()
    {
        echo "$this->id,$this->nombre,$this->precio,$this->tipo, $this->stock";
    }

}


?>