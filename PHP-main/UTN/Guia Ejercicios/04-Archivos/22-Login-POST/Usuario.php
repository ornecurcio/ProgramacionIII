<?php
    enum ELogin: int{
        case Verificado = 1;
        case ErrorDatos = 2;
        case Inexistente = 3;
        };
Class Usuario{
    private string $_nombre;
    private string $_mail;
    private string $_clave;

    function __construct(string $nombre,string $mail,string $clave){
        $this->_nombre = $nombre;
        $this->_mail = $mail;
        $this->_clave = $clave;
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