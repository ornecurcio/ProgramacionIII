<?php
    
Class Id{
    private static int $_number = 1;
        public static Function GetId(){
            $ret = Id::$_number;
            Id::$_number++;
            return $ret;
        }
    }
Class Producto implements \JsonSerializable{

    // public $STATUS_PRODUCTO = array(
    //     'INGRESADO' => 0,
    //     'ACTUALIZADO' => 1,
    //     'NULL'=>2     
    // );
    public string $_codBarra;
    public string $_nombre;
    public  string $_tipo;
    public int $_stock;
    public float $_precio;

    function __construct($codBarra,$nombre,
        $tipo,$stock,$precio){
             $this->_codBarra = $codBarra;
             $this->_nombre = $nombre;
             $this->_tipo = $tipo;
             $this->_stock = $stock;
             $this->_precio = $precio;
    }
    private function AumentarStock(){
        $this->_stock++;
    }
    public static function Equals(Producto $p1,Producto $p2){
        return $p1->_codBarra == $p2->_codBarra;
    }
    public function jsonSerialize(){
        return get_object_vars($this);
    }
    public function SerializarProducto(){
        return json_encode($this);
    }
    public static function SerializarProductos($productos){
        $jsonString = "";
        foreach ($productos as $item) {
            $jsonString .= $item->SerializarProducto();
        }
        return $jsonString;
    }
    private static function ExisteProducto($productos,Producto $p2){
        foreach ($productos as $item) {
            if(Producto::Equals($item,$p2)){
                return "existe";
            }
        }
        return "inexistente";
    }
    
    /**
     * @param $productos array de productos
     * @param Producto $p2 Producto a agregar en el array
     * return string "Agregado" si no existia y lo pudo agregar
     * return string "Modificado" si existia y lo modifico
     * return null si no pudo hacer
     */
    public static function Add($productos,Producto $p2){
        $ret = Producto::ExisteProducto($productos,$p2);
        if($ret == 'inexistente'){
            array_push($producto,$p2);      
            return "Agregado Producto";                  
        }
        else if($ret == 'existe'){
            $key = array_search($p2,$productos);
            $productos[$key]->AumentarStock();
            return "Stock Aumentado";
        }
        return null;        
    }

}



?>