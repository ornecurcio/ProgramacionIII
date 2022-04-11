<?php
    // enum ELogin: int{
    //     case Verificado = 1;
    //     case ErrorDatos = 2;
    //     case Inexistente = 3;
    //     };
Class Id{
    private static int $_number = 1;
        public static Function GetId(){
            $ret = Id::$_number;
            Id::$_number++;
            return $ret;
        }
    }
    
Class Usuario implements \JsonSerializable{
    private string $_nombre;
    private string $_mail;
    private string $_clave;
    public int $_id;
    private DateTime $_fechaAlta;


    function __construct(string $nombre,string $mail,string $clave,DateTime $fechaAlta){
        $this->_nombre = $nombre;
        $this->_mail = $mail;
        $this->_clave = $clave;
        $this->_fechaAlta = $fechaAlta;
        $this->_id = Id::GetId();
    }
    public function jsonSerialize(){
        return get_object_vars($this);
    }

    public static function ReadJSON(string $fileName = ''){
        $arrayJSON = [];

        if(!empty($fileName)){
            if(file_exists($fileName)){
                $archivo = fopen($fileName,'r');
                $fSize = filesize($fileName);

                if ($fSize > 0) {
                    $fread = fread($archivo,$fSize);
                } else {
                    $fread = '{}';
                }
                fclose($archivo);
                $arrayJSON = json_decode($fread);
            }
        }else{
            throw new Exception('Filename no puede estar vacio.<br/>');
        }

        return $arrayJSON;
    }
    public function MostrarDatos(){
        return $this->_nombre."/".$this->_mail."/".$this->_clave;
    }
    static function SaveFile(string $data,string $path="usuarios",bool $append=false,string $endFormat=".csv"){
        $ret = false;
        if(!Usuario::IsNullOrEmptyString($data)){
            $file;
            $path .= $endFormat;
            if($append){
                $file = fopen($path,"a");
                $data = "\r\n".$data;                             
            }
            else{
                $file = fopen($path,"w");                    
            }
            if(fwrite($file,$data) > 0){
                $ret = true;  
            }
        }
        fclose($file);
        return $ret;
    }

    private static function IsNullOrEmptyString($str){
        return ($str === null || trim($str) === '');
    }
    /**
     * @return true si los dos usarios son iguales
     * @return false si no coincide el mail
     * @return -1 si coincide el mail pero no la clave
     * return bool
     */
    public static function Verificar(Usuario $u1,Usuario $u2):ELogin{
        if($u1->_mail == $u2->_mail){
            if($u1->_clave == $u2->_clave){                 
                return ELogin::Verificado;
            }
            return ELogin::ErrorDatos;
        }
        return ELogin::Inexistente;
    }
}

?>