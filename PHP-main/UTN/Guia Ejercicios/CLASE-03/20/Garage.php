<?php

require "Auto.php";

class Garage{
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos;

    public function __construct($razonSocial, $precioPorHora=450){
        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioPorHora;
        $this->_autos = array();
    }

    public function getAutos(){
        return $this->_autos;
    } 

    public function MostrarGarage(){
        echo "<br>Razon Social: " . $this->_razonSocial;
        echo "<br>Precio por hora: " . $this->_precioPorHora;
        echo "<br>Autos: ";
        foreach ($this->_autos as $auto) {
            echo "<br>";
            Auto::MostrarAuto($auto);
        }
    }

    public function Equals($auto){
        foreach ($this->_autos as $autoGarage) {
            if ($autoGarage->Equals($auto)) {
                return true;
            }
        }
        return false;
    }

    public function Add($auto){
        if (count($this->_autos)==0 || !$this->Equals($auto)) {
            array_push($this->_autos, $auto);
        }
    }

    public function Remove($auto){
        if (count($this->_autos) > 0 && $this->Equals($auto)) {
            foreach ($this->_autos as $key => $autoGarage) {
                if ($autoGarage->Equals($auto)) {
                    unset($this->_autos[$key]);
                }
            }
        } else {
            echo "<br>El auto no esta en el garage, no se puede eliminar.";
        }
    }

    public function GarageGetData(){
    $stringCars = $this->_razonSocial . "," . $this->_precioPorHora .PHP_EOL;
    foreach ($this->getAutos() as $auto) {
        $stringCars .= $auto->CartoRow();
    }
        
        return $stringCars;
    }

    public static function GarageACSV($garage, $file="Garage.csv")
    {
    $file = fopen($file, "w");
    fwrite($file, $garage->GarageGetData()); 
    fclose($file);
    }

    public static function CSVAGarage($file="Garage.csv"): Garage
    {
        $counter = 0;
        $file = fopen($file, "r");
        while (!feof($file)) 
        {
            $line = fgets($file);
            if (!empty($line))
            {
                $line = str_replace(PHP_EOL, '', $line);
                $data = explode(',', $line);
                if($counter == 0)
                {
                    $garage = new Garage($data[0], $data[1]);
                }else
                {
                    $auto = new Auto($data[0], $data[1], $data[2], $data[3]);
                    $garage->Add($auto);
                }
                $counter++;
            }
        }            
        fclose($file);

        return $garage;
    }
}
?>