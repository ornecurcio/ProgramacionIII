<?php
include "Auto.php";
   Class Garage
   {

        private $_razonSocial;
        private $_precioPorHora;
        private $_autos =[];

        function __construct($razonSocial, $precioPorHora, $autos = array())
        {
            if(is_string($razonSocial))
            {
                $this->_razonSocial = $razonSocial;
            }
            
            if(is_float($precioPorHora))
            {
                $this->_precioPorHora = $precioPorHora; 
            }

            if(is_array($autos))
            {
                $this->_autos = $autos;
            }
        }

        public function MostrarGarage()
        {
            $s = array($this->_razonSocial,$this->_precioPorHora);
            $s = implode("<br/>",$s);   
            $s .= "<br/>"; 
            // //Opcion 1
            // //var_dump($this->_autos);
            foreach ($this->_autos as $item) 
            {
                $s .= Auto::MostrarAuto($item);
                //echo (Auto::MostrarAuto($item)); 
            }
            //Opcion 2
            // $auxArray = array_values($this->_autos);
            // foreach ($auxArray as $item) {
            //         $s .= "<br/>" . Auto::MostrarAuto($item);
            //     }
           return $s;
        }

        public function Equals(Auto $a)
        {
            //$bool = array_search($a,$this->_autos);
            //echo($bool);
            //return $bool;
            return in_array($a,$this->_autos);
        }

        public function Add(Auto $a)
        {
            if(!$this->equals($a))
            {            
                array_push($this->_autos,$a);
                return true;
            }
            return false;
        }

        public function Remove(Auto $a)
        {
            $key = array_search($a, $this->_autos);
            if($key != false){ 
                // echo(Auto::MostrarAuto($this->_autos[$key]));
                // echo("Antes de eliminar: " . var_dump($this->_autos));
                unset($this->_autos[$key]);
                // echo(Auto::MostrarAuto($this->_autos[$key]));
                // echo(var_dump("Dsp de eliminar: " .$this->_autos));
                return true;
            }
            return false;
        }
    //     function __construct()
    //     {
    //         // $this->_autos = array();
    //         //obtengo un array con los parámetros enviados a la función
    //         $params = func_get_args();
    //         //saco el número de parámetros que estoy recibiendo
    //         $num_params = func_num_args();
    //         //cada constructor de un número dado de parámtros tendrá un nombre de función
    //         //atendiendo al siguiente modelo __construct1() __construct2()...
    //         $funcion_constructor ='__construct'.$num_params;
    //         //compruebo si hay un constructor con ese número de parámetros
    //         if (method_exists($this,$funcion_constructor)) {
    //             //si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
    //             call_user_func_array(array($this,$funcion_constructor),$params);
    //         }
    //     }  
	// //ahora declaro una serie de métodos constructores que aceptan diversos números de parámetros
    //     function __construct0()	{
    //         $this->__construct1("Default");
    //     }	
    //     function __construct1(string $_razonSocial){
    //         $this->__construct2($_razonSocial,0);
    //     }		
    //     function __construct2(string $_razonSocial,string $_precioPorHora){
    //         $this->_razonSocial = $_razonSocial;
    //         $this->_precioPorHora = $_precioPorHora;
            
    //     }
        

        // public function Equals(Auto $a){
        //     $aux = array_search($a,$this->_autos);
        //     echo($aux);
        //     return $aux;
            //Opcion 1
            // if(in_array($a,$this->_autos)){
            //     return true;
            // }
            // return false;
            //Opcion 2
            // echo("Vardumqp:" . var_dump($this->_autos));
            // $arrayAux = $this->_autos;
            // echo("datos>>>:" . var_dump($a));
            // foreach ($arrayAux as $item) {
            //     var_dump($item);
            //     if($item->Equals($a)){
            //         return true;
            //     }
            // }
            //Opcion 3
            // foreach ($a as $item) {
            //     if($item->Equals($a)){
            //         return true;
            //     }
            // }
            // return false;
        // }    
        // public function Add(Auto $a){
        //     if(!$this->equals($a)){            
        //         array_push($this->_autos,$a);
        //         return true;
        //     }
        //     return false;
        // }
        // public function Remove(Auto $a){
        //     $key = $this->equals($a);
        //     if($key != false){ 
        //         // echo(Auto::MostrarAuto($this->_autos[$key]));
        //         // echo("Antes de eliminar: " . var_dump($this->_autos));
        //         unset($this->_autos[$key]);
        //         // echo(Auto::MostrarAuto($this->_autos[$key]));
        //         // echo(var_dump("Dsp de eliminar: " .$this->_autos));
        //         return true;
        //     }
        //     return false;
        // }
   }
?>