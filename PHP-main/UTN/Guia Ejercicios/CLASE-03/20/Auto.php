<!-- Ornela Ivana Curcio -->

<?php
class Auto{

    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($color, $marca, $precio=10000, $fecha="15/08/2022"){
        $this->_color = $color;
        $this->_marca = $marca;
        $this->_precio = $precio;
        $this->_fecha = $fecha;
    }

    function setColor($color){
        if (is_string($color) && !empty($color)) {
            $this->_color = $color;
        }
    }

    function setPrecio($precio){
        if (is_float($precio) && $precio > 0) {
            $this->_precio = $precio;
        }
    }
    
    function setMarca($marca){
        if (is_string($marca) && !empty($marca)) {
            $this->_marca = $marca;
        }
    }

    function getColor(){
        return $this->_color;
    }

    function getPrecio(){
        return $this->_precio;
    }

    function getMarca(){
        return $this->_marca;
    }

    public function AgregarImpuesto($impuesto){
        $this->_precio += $impuesto;
    }

    public static function MostrarAuto(Auto $auto){
        echo "<br>Color: " . $auto->_color;
        echo "<br>Marca: " . $auto->_marca;
        echo "<br>Precio: " . $auto->_precio;
        echo "<br>Fecha: " . $auto->_fecha;
    }

    public function Equals($auto){
        return $this->_marca == $auto->_marca;
    }

    public static function Add($auto1, $auto2){
        if($auto1->Equals($auto2) && $auto1->_color == $auto2->_color){
            return $auto1->_precio + $auto2->_precio;
        }else{
            return 0;
        }
    }

    public function CartoRow(){
        return $this->_color . "," . $this->_marca . "," . $this->_precio . "," . $this->_fecha.PHP_EOL;
    }

    public static function PersistenceCSV($arrayAuto, $fileName='autos.csv'): bool
    {
        $success = 0;
        $file = fopen($fileName, 'a');
        foreach ($arrayAuto as $auto) {
            $success += fwrite($file, $auto->CartoRow() . PHP_EOL);
        }
        fclose($file);

        return $success;
    }

    public static function ReadCSV($fileName='autos2.csv'): array
    {
        $arrayAutos = array();
        $file = fopen($fileName, 'r'); 
        while (!feof($file)) {
            $line = fgets($file);
            if (!empty($line)) {
                $line = str_replace(PHP_EOL, '', $line);
                $arrayAuto = explode(';', $line);
                $auto = new Auto($arrayAuto[0], $arrayAuto[1], $arrayAuto[2], $arrayAuto[3]);
                array_push($arrayAutos, $auto);
            }
        }
        fclose($file);

        return $arrayAutos;
    }
}
?>