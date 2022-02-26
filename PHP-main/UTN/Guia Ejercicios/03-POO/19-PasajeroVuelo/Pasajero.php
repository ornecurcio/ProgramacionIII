<?php
   Class Pasajero{
    private string $_apellido;
    private string $_nombre;
    private string $_dni;
    public bool $_esPlus;

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
		$this->__construct1("");
	}	
    function __construct1(string $_apellido){
		$this->__construct2($_apellido,"");
	}		
    function __construct2(string $_apellido,string $_nombre){
        $this->_apellido = $_apellido;
		$this->_nombre = $_nombre;     
        __construct3($_apellido,$_nombre,"");
	}
    function __construct3(string $_apellido,string $_nombre,string $_dni){
        __construct3($_apellido,$_nombre,"",false);  
	}
    function __construct4(string $_apellido,string $_nombre,string $_dni,bool $_esPlus){
        $this->_apellido = $_apellido;
		$this->_nombre = $_nombre;    
        $this->_dni = $_dni;      
        $this->_esPlus = $_esPlus;      
	}
    public function Equals(Pasajero $p){
        return $this->_dni == $p->_dni;
    }
    public function GetInfoPasajero() : string{
        $s = array($this->_apellido,$this->_nombre,$this->_dni,$this->_esPlus);
        return implode("<br/>",$s);   
    }
    public static function MostrarPasajero(Pasajero $p){
        echo($p->GetInfoPasajero());
    }
}
?>