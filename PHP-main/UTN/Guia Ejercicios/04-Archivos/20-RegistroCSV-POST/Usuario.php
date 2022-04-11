<?php
Class Usuario{

    private string $_nombre;
    private string $_mail;
    private string $_clave;

    function __construct(string $nombre,string $mail,string $clave)
    {
        $this->_nombre = $nombre;
        $this->_mail = $mail;
        $this->_clave = $clave;
    }

    public function MostrarDatos()
    {
        return "/".$this->_nombre."/".$this->_mail."/".$this->_clave;
    }
    static function SaveFile(string $data,string $path="usuarios",bool $append=false,string $endFormat=".csv")
    {
        $ret = false;
        if(!Usuario::IsNullOrEmptyString($data))
        {
            $file;
            $path .= $endFormat;
            if($append)
            {
                $file = fopen($path,"a");
                $data = "\r\n".$data;                             
            }
            else
            {
                $file = fopen($path,"w");                    
            }
            if(fwrite($file,$data) > 0)
            {
                $ret = true;  
            }
        }
        fclose($file);
        return $ret;
    }

    private static function IsNullOrEmptyString($str)
    {
        return ($str === null || trim($str) === '');
    }
}

?>