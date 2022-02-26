<?php
Class Auto{
    //https://www.php.net/manual/en/function.func-get-args.php
    // property declaration
    private string $_color;
    private float $_precio;
    private string $_marca;
    private DateTime $_fecha;

    function __construct()
	{
		//obtengo un array con los parámetros enviados a la función
		$params = func_get_args();
		//saco el número de parámetros que estoy recibiendo
		$num_params = func_num_args();
		//cada constructor de un número dado de parámtros tendrá un nombre de función
		//atendiendo al siguiente modelo __construct1() __construct2()...
		$funcion_constructor ='__construct'.$num_params;
		//compruebo si hay un constructor con ese número de parámetros
		if (method_exists($this,$funcion_constructor)) {
			//si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
			call_user_func_array(array($this,$funcion_constructor),$params);
		}
	}  
	//ahora declaro una serie de métodos constructores que aceptan diversos números de parámetros
	function __construct0()	{
		$this->__construct1("Default");
	}	
    function __construct1(string $marca){
		$this->__construct2($marca, "Gris");
	}		
    function __construct2(string $marca,string $color){
		$this->__construct3($marca,$color,0);
	}
    function __construct3(string $marca,string $color,float $precio){
        $this->__construct4($marca,$color,$precio,date_create("now"));
    }
    function __construct4(string $marca,string $color,float $precio,DateTime $fecha){
        $this->_marca = $marca;
		$this->_color = $color;
        $this->_precio = $precio;
        $this->_fecha = $fecha;
    }
    public function AgregarImpuestos(float $imp){
        $this->_precio += $imp;
    }
    public static function MostrarAuto(Auto $a){
        $s = array($a->_marca,$a->_color,$a->_precio,$a->_fecha->format('d/m/Y'));
        $s = implode("<br/>",$s);   
        $s .= "<br/>"; 
        return $s;
    }
    public function Equals(Auto $a2){
        return $this->_marca == $a2->_marca;
    }
    public static function Add(Auto $a1,Auto $a2){
        if($a1->equals($a2) && $a1->_color == $a2->_color){            
            return $a1->_precio + $a2->_precio;
        }
        return 0;
    }


}
?>


