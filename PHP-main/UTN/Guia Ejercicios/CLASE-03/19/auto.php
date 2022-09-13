<!-- Curcio Ornela Ivana -->
<!-- Aplicación No 19 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos
privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)
Realizar un constructor capaz de poder instanciar objetos pasándole como
parámetros: i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.
Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble
por parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un
archivo autos.csv.
Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
autos.csv
Se deben cargar los datos en un array de autos.
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5) -->


<?php
class Auto
{
    private $__marca;
    private $__color;
    private $__precio;
    private $__fecha;

    // Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
    // i. La marca y el color.
    // ii. La marca, color y el precio.
    // iii. La marca, color, precio y fecha.
    public function __construct(string $marca, string $color,  $precio = NULL, $fecha = NULL)
    {
        $this->__marca = $marca;
        $this->__color = $color;
        $this->__precio = $precio;
        $this->__fecha = $fecha;
    }
    
    // Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
    // parámetro y que se sumará al precio del objeto.
    public function AgregarImpuestos(float $aniadido)
    {
        if($this->__precio != null)
        {
            $this->__precio = $this->__precio + $aniadido;
        }
        else
        {
            return "ERROR: Asigne un precio al auto.";
        }
        
    }

    // Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
    // por parámetro y que mostrará todos los atributos de dicho objeto.
    public static function MostrarObjeto(Auto $auto)
    {
        if($auto != null)
        {
            printf("AUTO <br>");
            printf("Marca: $auto->__marca <br>");
            printf("Color: $auto->__color <br>");

            if($auto->__precio != null)
            {
                printf("Precio: $auto->__precio <br>");
            }
            else
            {
                printf("Precio: (no consta) <br>");
            }

            if($auto->__fecha != null)
            {
                echo "Fecha: ".$auto->__fecha->format('d-m-Y')."<br>";
            }
            else
            {
                printf("Fecha: (no consta) <br>");
            }

        }
        else
        {
            printf("El auto no existe");
        }
    }

    public static function MostrarArrayDeObjetos($arrayDeObjetos)
    {
        foreach($arrayDeObjetos as $item)
        {
            Auto::MostrarObjeto($item);
        }
    }

    // Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
    // devolverá TRUE si ambos “Autos” son de la misma marca.
    public function Equals(Auto $autoUno, Auto $autoDos)
    {
        if(($autoUno != null) && ($autoDos != null))
        {
            if($autoUno->__marca == $autoDos->__marca)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            printf("ERROR: alguno o los dos autos son nulos");
        }
    }

    // Crear un método de clase, llamado Add que permita sumar dos objetos “Auto” (sólo si son
    // de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
    // la suma de los precios o cero si no se pudo realizar la operación.

    public static function Add (Auto $autoUno, Auto $autoDos)
    {
        if(($autoUno != null) && ($autoDos != null))
        {
            //printf("llega aquí??? 1");
         
            if($autoUno->Equals($autoUno, $autoDos) == 1 && $autoUno->__color == $autoDos->__color)
            {
                return $autoUno->__precio + $autoDos->__precio;
         
            }
            else
            {
                return "ERROR: los autos son de diferente marco y/o color";
              
            }
        }
        else
        {
            return "ERROR: alguno o los dos autos son nulos";
          
        }
    }

    public static function GrabarEnCsv($item, $ruta)
    {             
        $retorno = false;
        if($item->__fecha != NULL)
        {
            $item->__fecha = $item->__fecha->format("Y-m-d");
            //var_dump($item);
        }
        if($item)
        {
            //var_dump($item);
            $separadoPorComa = implode(",", (array)$item);
            //var_dump($separadoPorComa);
            printf("<br>");
            $file = fopen($ruta, "a+");
            if($file)
            {
                fwrite($file, $separadoPorComa.PHP_EOL); 
            }                 
            fclose($file);   
            $retorno = true;
        }
        return $retorno;                  
    }

    public static function GrabarArrayEnCsv($array, $ruta)
    {
        $retorno = false;

        foreach($array as $item)
        {        
            //var_dump($item);
            printf("<br>");
            if(Auto::GrabarEnCsv($item, $ruta))
            {
                $retorno = true;
            }
        }
        return $retorno;
    }

    public static function LeerCsv($archivo)
    {
        $auxArchivo = fopen($archivo, "r");
        //var_dump($auxArchivo);
        $array = [];

        if(isset($auxArchivo))
        {
            try
            {
                while(!feof($auxArchivo))
                {
                    $registro = fgets($auxArchivo);        
                    if(!empty($registro))
                    {
                        $campo = explode(",", $registro); 
                        //var_dump($campo);
                        if(strlen(trim($campo[3])) == null)
                        {
                           $campoTres = null;
                        }   
                        else
                        {
                            $campoTres = new Datetime($campo[3]);
                            //$campoTres = null;
                        }                 
                        array_push($array, new Auto($campo[0], $campo[1], $campo[2], $campoTres)); 
                                            
                    }
                }
                //var_dump($array); 
            }
            catch(\Throwable $e)
            {
                echo "No se pudo leer el archivo<br>";
                printf($e);

            }
            finally
            {
                fclose($auxArchivo);
                return $array;
            }
            
        }
    }

}

?>