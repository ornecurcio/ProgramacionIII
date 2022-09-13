<?php

class usuario
{
    private $_nombre;
    private $_clave;
    private $_mail;

    public function __construct($nombre, $clave, $mail)
    {
        $this->_nombre = $nombre;
        $this->_clave = $clave;
        $this->_mail = $mail;
    }

    public static function GrabarEnCsv($usuario, $ruta)
    {             
        $retorno = false;
        if($usuario)
        {
            $separadoPorComa = implode(",", (array)$usuario);
            $file = fopen($ruta, "a+");
            printf("El var_dump de file: --> ");
            var_dump($file);
            if($file)
            {
                printf("entra en el segundo if <br>");
                fwrite($file, $separadoPorComa.PHP_EOL); 
            }                 
            fclose($file);   
            $retorno = true;
        }

        return $retorno;                  
    }

}

?>