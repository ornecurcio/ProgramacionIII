<?php
abstract class FiguraGeometrica{
    // property declaration
    protected string $_color;
    protected float $_perimetro;
    protected float $_superficie;


    public function __construct() {
        $_color = "Grey";
    }    
    abstract protected function CalcularDatos();
    abstract public function Dibujar() : string;
    public function GetColor(){
        return $this->$_color;
    }
    public function SetColor(string $c){
        $this->$_color = $c;
    }
    public function ToString(){
        return  $this->$_color . $this->$_perimetro . $this->$_superficie;
    }


    

}
?>
