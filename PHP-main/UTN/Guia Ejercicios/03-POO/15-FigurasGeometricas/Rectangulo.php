<?php
class Rectangulo extends FiguraGeometrica{
    // property declaration
    protected float $_ladoDos;
    protected float $_ladoUno;

    public function __construct(float $l1,float $l2){
        parent::__construct();
        $this->CalcularDatos();
        $_ladoUno = $l1;
        $_ladoDos = $l2;        
    }
    protected function CalcularDatos(){
        $_perimetro = 0;
        $_superficie = 0;
    }
    public function Dibujar() : string{       
         
        $array = array("***","***","***");
        $auxDeCientifico = implode("<br/>",$array);
        return $auxDeCientifico;
        
        // $s = "***<br/>";
        // $s .= "***<br/>";
        // $s .= "***<br/>";
        
        // return $s;

        // $n = 8;
        // if ($n<2) {
        //     return [];
        // }
        // $my_array = array_fill(0, $n, "*".str_repeat(" ", $n-2)."*");
        // $my_array[0] = $my_array[$n-1] = str_repeat("*", $n);
        // $auxDeSenior = implode("",$my_array);
        // return $auxDeSenior;
    }
}
?>


