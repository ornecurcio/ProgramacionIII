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

    public static function AltaAutos($autos)
    {
        if(file_exists('auto.csv'))
        {
            if(filesize('auto.csv')>0)
            {
                $archivo = fopen('auto.csv', 'a');
            }
        }
        else
        {
            $archivo = fopen('auto.csv', 'w');
        }
        
        if(is_array($autos) && $archivo!==false)
        {
            
            foreach($autos as $auto)
            { 
                fputcsv($archivo, get_object_vars($auto));
            }
            fclose($archivo);
        }
        else
        {
            die("Error al abrir archivo"); 
        }
    }

    public static function LeerAuto()
    {
        if(($archivo = fopen('auto.csv', 'r'))!== false)
        {
            echo "Los datos de los usarios son:"; 
            while(($datos = fgetcsv($archivo))!== false)
            {
                for($i = 0; $i < count($datos); $i++)
                {
                    echo $datos[$i]."<br>";
                }
            }
        }
        else
        {
            fclose($archivo);
        }
    }

    // public static function GuardarAuto(string $data,string $path="autos",bool $append=false,string $endFormat=".csv")
    // {
    //     $ret = false;
    //     if($data!=NULL)
    //     {
    //         $file;
    //         $path .= $endFormat;
    //         if($append)
    //         {
    //             $file = fopen($path,"a");
    //             $data = "\r\n".$data;                             
    //         }
    //         else
    //         {
    //             $file = fopen($path,"w");                    
    //         }
    //         if(fwrite($file,$data) > 0)
    //         {
    //             $ret = true;  
    //         }
    //     }
    //     fclose($file);
    //     return $ret;
    // }

    // public function __toString()
    // {
    //     return $this->_marca . " " . $this->_color;
    // }

    // public function __get($name)
    // {
    //     //Acá dentro hacer la lógica a la hora de obtener un atributo de la clase.
    //     return $this->$name;
    // }
    
    // public function __set($name, $value)
    // {
    //     echo "Estableciendo atributo '$name' a '$value'\n";
    //     $this->$name = $value;
    // }
}
?>


