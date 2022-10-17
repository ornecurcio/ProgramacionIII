<?php

class Venta{

    public int $_numeroDePedido;
    public int $_id;
    public string $_mailUsuario;
    public string $_sabor;
    public string $_tipo;
    public int $_cantidad;
    public string $_fechaDePedido;
    public bool $_estaBorrada;

    public function __construct($id,$mailUsuario,$sabor,$tipo,$cantidad, $numeroDePedido,$fechaDePedido="")
    { 
        $this->_id = $id;   
        $this->_mailUsuario = $mailUsuario;   
        $this->_sabor = $sabor; 
        $this->_tipo = $tipo;
        $this->_cantidad = $cantidad;    
        if($fechaDePedido=="")
        {
            $fechaActual = new DateTime(date('y-m-d h:i:s'));
            $this->_fechaDePedido = $fechaActual->format('y-m-d');
        }
        else
        {
            $this->_fechaDePedido = $fechaDePedido;
        }    
        $this->_numeroDePedido = $numeroDePedido;
    }

    public function GuardarImagen()
    {       
        $nombreFoto = $this->_tipo."_".$this->_sabor."_".$this->_mailUsuario."_".$this->_fechaDePedido.".jpg";
        $destino = ".".DIRECTORY_SEPARATOR."ImagenesDeLaVenta".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;

        if(!file_exists($destino))
        {
            mkdir($destino, 0777, true);
        }

        $dir = $destino.$nombreFoto;
        //$tmpName = $_FILES["archivo"]["tmp_name"];
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $dir);
        return $dir;
    }

    // public function GuardarImagen()
    // {
    //     $nombreMailFiltrado = explode("@",$this->_mailUsuario);    
    //     if(!file_exists(".".DIRECTORY_SEPARATOR."ImagenesDeLaVenta".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR))
    //     {
    //         mkdir(".".DIRECTORY_SEPARATOR."ImagenesDeLaVenta".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, 0777, true);
    //     }   
    //     $nombreDeArchivo = "$this->_tipo - $this->_sabor - $nombreMailFiltrado[0]@";
    //     $destino = "ImagenesDeLaVenta/" . $nombreDeArchivo . ".jpg";
    //     $tmpName = $_FILES["imagen"]["tmp_name"];
    //     if (move_uploaded_file($tmpName, $destino)) 
    //     {
    //         echo "La foto se guardó correctamente\n";
    //         return true;
    //     } 
    //     else 
    //     {
    //        echo "La foto no pudo gurdarse";
    //        return false;
    //     }
    // }
    public function Mostrar()
    {
        echo "$this->numeroDePedido,$this->id,$this->mailUsuario,$this->sabor, $this->tipo,$this->cantidad,$this->fechaDePedido";
    }
}

?>