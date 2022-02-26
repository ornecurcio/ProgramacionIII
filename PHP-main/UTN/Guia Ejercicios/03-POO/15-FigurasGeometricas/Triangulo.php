<?php
class Triangulo extends FiguraGeometrica{

    protected float $_altura;
    protected float $_base;
    public function __construct(float $l1,float $l2){
        parent::__construct();
        $this->CalcularDatos();
        $_base = $l1;
        $_altura = $l2;        
    }
    protected function CalcularDatos(){
        $_perimetro = 0;
        $_superficie = 0;
    }
    public function Dibujar() : string{

        $array = array("*","**","***");
        $auxDeCientifico = implode("<br/>",$array);
        return $auxDeCientifico;
    }
}
?>