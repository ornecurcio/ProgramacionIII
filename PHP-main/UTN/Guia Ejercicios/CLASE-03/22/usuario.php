<?php

class usuario
{
    private $_clave;
    private $_mail;

    public function __construct($clave, $mail)
    {
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
            //var_dump($file);
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
                        $campo = explode(",", $registro); 
                        //var_dump($campo);                     
                        array_push($array, new Usuario($campo[0], $campo[1])); 
                                            
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
            printf("<li> $valor </li>");
        }
        printf("</ul>");
    }

    private function MailEnSistema($arrayDeUsuarios, $usuario)
    {
        $retorno = 0;

        foreach($arrayDeUsuarios as $item)
        {
            $item->ImprimirUsuario();
            $usuario->ImprimirUsuario();
            if(trim($item->_mail) == trim($usuario->_mail))
            {
                $retorno = $this->_mail;
                break;
            }
        }
        return $retorno;
    }

    private function ClaveEnSistema($arrayDeUsuarios, $mail)
    {
        $retorno = false;

        if($this->_mail == $mail)
        {
            foreach($arrayDeUsuarios as $item)
            {
                if($item->_clave == $this->_clave)
                {
                    $retorno = true;
                }
            }
        }
       
        return $retorno;
    }

    public function Login($archivo, $usuario)
    {

        $arrayDeUsuarios = array();
        $arrayDeUsuarios = Usuario::LeerCsv($archivo);
        $mailCorrecto = $this->MailEnSistema($arrayDeUsuarios, $usuario);
        $claveCorrecta = $this->ClaveEnSistema($arrayDeUsuarios, $mailCorrecto);

        if($mailCorrecto != 0 && !$claveCorrecta)
        {
            printf("Error en los datos");
        }
        if(!$mailCorrecto)
        {
            printf("Usuario no registrado");
        }
        if ($mailCorrecto != 0 && $claveCorrecta)
        {
            printf("Verificado.");
        }
    }

}

?>