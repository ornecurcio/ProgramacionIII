<?php

class Venta{

    public int $numeroDePedido;
    public int $id;
    public string $mailUsuario;
    public string $nombre;
    public string $tipo;
    public int $cantidad;
    public string $fechaDePedido;
    public bool $estaBorrada;

    public function __construct($id,$mailUsuario,$nombre,$tipo,$cantidad, $numeroDePedido,$fechaDePedido="")
    { 
        $this->id = $id;   
        $this->mailUsuario = $mailUsuario;   
        $this->nombre = $nombre; 
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;    
        if($fechaDePedido=="")
        {
            $fechaActual = new DateTime(date('y-m-d h:i:s'));
            $this->fechaDePedido = $fechaActual->format('y-m-d');
        }
        else
        {
            $this->fechaDePedido = $fechaDePedido;
        }    
        $this->numeroDePedido = $numeroDePedido;
    }

    public function GuardarImagen()
    {
        $nombreMailFiltrado = explode("@",$this->mailUsuario);    
        if(!file_exists(".".DIRECTORY_SEPARATOR."ImagenesDeLaVenta".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR))
        {
            mkdir(".".DIRECTORY_SEPARATOR."ImagenesDeLaVenta".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, 0777, true);
        }   
        $nombreDeArchivo = "$this->tipo - $this->nombre - $nombreMailFiltrado[0]@";
        $destino = "ImagenesDeLaVenta/" . $nombreDeArchivo . ".jpg";
        $tmpName = $_FILES["archivo"]["tmp_name"];

        if (move_uploaded_file($tmpName, $destino)) 
        {
            echo "El archivo se guardó correctamente\n";
            return true;
        } 
        else 
        {
           echo "El archivo no pudo gurdarse";
           return false;
        }
    }
    public function Mostrar()
    {
        echo "$this->numeroDePedido,$this->id,$this->mailUsuario,$this->nombre, $this->tipo,$this->cantidad,$this->fechaDePedido";
    }
}

?>