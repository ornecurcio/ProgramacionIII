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
        //var_dump($usuario);
        if($usuario)
        {
            $separadoPorComa = implode(",", (array)$usuario);
            $file = fopen($ruta, "a+");
            if($file)
            {
                fwrite($file, $separadoPorComa.PHP_EOL); 
            }                 
            fclose($file);   
            $retorno = true;
        }
        return $retorno;                  
    }

    public static function LeerCsv($archivo)
    {
        $auxArchivo = fopen($archivo, "r");
        //var_dump($auxArchivo);
        $array = [];

        if(isset($auxArchivo))
        {
            try
            {
                while(!feof($auxArchivo))
                {
                    $registro = fgets($auxArchivo);
                    
                    if(!empty($registro))
                    {
                        //printf("entra a este if");
                        $campo = explode(",", $registro); 
                        //var_dump($campo);                     
                        array_push($array, new Usuario($campo[0], $campo[1], $campo[2])); 
                                            
                    }
                }
                //var_dump($array); 
            }
            catch(\Throwable $e)
            {
                echo "No se pudo leer el archivo<br>";
                printf($e);

            }
            finally
            {
                fclose($auxArchivo);
                return $array;
            }
            
        }
    }

    public static function ImprimirCsv($archivo)
    {
        $arrayDeUsuarios = Usuario::LeerCsv($archivo);
        //var_dump($arrayDeUsuarios);
        
        if(sizeof($arrayDeUsuarios) > 0)
        {
           Usuario::ImprimirListaDeUsuarios($arrayDeUsuarios);
        }

    }

    public static function ImprimirListaDeUsuarios($arrayDeUsuarios)
    {
        foreach((array)$arrayDeUsuarios as $usuario)
        {
            $usuario->ImprimirUsuario();
        }
    }

    public function ImprimirUsuario()
    {
        printf("USUARIO");
        printf("<ul>");
        foreach((array)$this as $valor)
        {
            // printf("<ul>");
            printf("<li> $valor </li>");
            // printf("</ul>");
        }
        printf("</ul>");
    }

}

?>