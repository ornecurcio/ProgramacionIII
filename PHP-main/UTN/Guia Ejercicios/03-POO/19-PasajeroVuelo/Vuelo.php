<?php
require_once("Pasajero.php");
   Class Vuelo{
    private string $_empresa;
    private DateTime $_fecha;
    private float $_precio;
    public $_listaDePasajeros = [];
    private int $_cantMaxima;

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
    function __construct1(string $_empresa){
		$this->__construct2($_empresa,date_create("now"));
	}		
    function __construct2(string $_empresa,DateTime $_fecha){
        $this->__construct3($_empresa,$_fecha,0);
	}
    function __construct3(string $_empresa,DateTime $_fecha,float $_precio){
        $this->__construct4($_empresa,$_fecha,$_precio,10);  
	}
    function __construct4(string $_empresa,DateTime $_fecha,float $_precio,int $_cantMax){
        $this-> __construct5($_empresa,$_fecha,$_precio,$_cantMax);   
	}
    function __construct5(string $_empresa,DateTime $_fecha,float $_precio,int $_cantMax,$_listaDePasajeros=[]){
        $this->_empresa = $_empresa;
		$this->_fecha = $_fecha;    
        $this->_precio = $_precio;      
        $this->_listaDePasajeros = $_listaDePasajeros;     
        $this->_cantMaxima = $_cantMax;
	}
    public function GetInfoVuelo(){
        $s = array($this->_empresa,$this->_fecha->format('d/m/Y'),$this->_precio,$this->_cantMaxima);
        $str = implode("<br/>",$s);  
        foreach ($this->_listaDePasajeros as $item) {
            $str .= "<br/>" . $item->GetInfoPasajero();
        }
        return "<br/>" . $str;   
    }
    public function Equals(Pasajero $p){
        return array_search($p,$this->_listaDePasajeros);
    }
    public function AgregarPasajero(Pasajero $p){
        if(!$this->Equals($p) && (count($this->_listaDePasajeros) < $this->_cantMaxima)){
            return array_push($this->_listaDePasajeros,$p);
        }
        return false;
    }
    public function MostrarVuelo(){
        echo("<br/>" . "Info del vuelo:". "<br/>" . $this->GetInfoVuelo());
    }
    public static function Add(Vuelo $v1,Vuelo $v2):float{
        //Opcion 1
        $v1Sum = Vuelo::SumPreciosTickets($v1);
        $v2Sum = Vuelo::SumPreciosTickets($v2);
        return $v1Sum+$v2Sum;
        //Opcion 2
        // $aux = array_walk($v1,"SumPreciosTickets");
        // $aux += array_walk($v2,"SumPreciosTickets");
        // return $aux;
    }
    private static function SumPreciosTickets(Vuelo $v){
        $sumTotal = 0;
        foreach ($v->_listaDePasajeros as $item) {
            if ($item->_esPlus) {
                $sumTotal += $v->_precio *0.80;
            }
            else{
                $sumTotal += $v->_precio;
            }
        }
        return $sumTotal;
    }
    //Usando array_walk?
    // private static function SumPreciosTickets(Vuelo $v){
    //     return array_walk($v->_listaDePasajeros,"GetPrecioTicket",$v); 
    // }
    // private static function GetPrecioTicket(Pasajero $p,Vuelo $v){
    //     if($p->_esPlus){
    //         return $v->_precio * 0.80;
    //     }
    //     return $v->_precio;
    // } 
    public static function Remove(Vuelo $v,Pasajero $a){
        $key = $v->equals($a);
        if($key != false){ 
            echo("Entro aca!!!");
            unset($v->_listaDePasajeros[$key]);
            return true;
        }
        return false;
    }

}
?>