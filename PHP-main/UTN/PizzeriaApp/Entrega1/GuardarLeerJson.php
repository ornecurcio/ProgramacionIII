<?php

class GuardarLeerJson
{
    public static function GrabarEnJson($array, $ruta)
    {
        $retorno = false;

        try
        {
            $archivo = fopen($ruta, 'w');
    
            if($archivo)
            {
                $json = json_encode($array, JSON_PRETTY_PRINT); 
                fwrite($archivo, $json);

                $retorno = true;
            }
        }
        catch (Throwable $mensaje)
        {
            printf("Error al guardar el archivo: <br> $mensaje");
        }
        finally
        {
            fclose($archivo);
            return $retorno;
        }
    }

    public static function LeerJson($ruta)
    {
        try
        {
            $archivo = fopen($ruta, "r");
            //var_dump($archivo);
            if($archivo)
            {
                
                $contenido = fread($archivo, filesize($ruta));
                $array = json_decode($contenido, true);
            }
            else
            {  
                $array = array();
            }
        }
        catch (Throwable $mensaje)
        {          
            printf("Error al leer el archivo: <br> $mensaje");
        }
        finally
        {        
            return $array;
            fclose($archivo);
            
        }  
    }
}



?>