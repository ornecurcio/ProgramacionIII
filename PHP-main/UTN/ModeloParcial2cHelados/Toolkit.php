<?php

class Toolkit
{
    public static function AsignarId($item, $array)
    {
        $idMasAlto = 0;  

        if(sizeof($array) > 0)
        {                    
            foreach($array as $auxItem)
            {          
                $id = Toolkit::SacarValorDeClave($auxItem, "_id");
            
                if($id >= $idMasAlto)
                {
                    $idMasAlto = $id;
                }
            }
        }    
        $item->_id = $idMasAlto + 1;
    }

    public static function SacarValorDeClave($objeto, $clave)
    {
        foreach($objeto as $claveAux => $valor)
        {
            if($claveAux == $clave)
            {
                return $valor;
            }
        }
    }

    public static function ConsultaSiHayYCual($item, $array)
    {   
        $retorno = -1;

        for($i = 0 ; $i < sizeof($array) ; $i++)
        {         
            if($item->Equals($array[$i], $item))
            {
                $retorno = $i;
                break;
            }
        }
        return $retorno;
    }

    public static function ExisteUnValorEnArray($item, $array, $clave)
    {
        $retorno = false;
        $valorItem = Toolkit::SacarValorDeClave($item, $clave);

        foreach($array as $aux)
        {
            $valorAux = Toolkit::SacarValorDeClave($aux, $clave);

            if($valorAux == $valorItem)
            {
                $retorno = true;
                break;       
            }
        }
        return $retorno;
    }

    public static function ConseguirIdPorElIndex($item, $array)
    {
        $retorno = -1;

        $indice = Toolkit::ConsultaSiHayYCual($item, $array);

        if($indice > -1)
        {
            $retorno = Toolkit::SacarValorDeClave($array[$indice], "_id");
        }

        return $retorno;
    }

    public static function ConseguirObjetoPorId($id, $array)
    {
        $retorno = null;

        foreach($array as $item)
        {
            $idAux = Toolkit::SacarValorDeClave($item, "_id");
            if($idAux == $id)
            {
                $retorno = $item;
                break;
            }
        }
        return $retorno;
    }

    public static function ImprimirConsulta($consulta)
    {       
        $retorno = null;

        try
        {
            $retorno = array();
            $conexion = AccesoDatos::dameUnObjetoAcceso();

            $resultado = $conexion->RetornarConsulta($consulta);
            $resultado->execute();
            $retorno = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Throwable $mensaje)
        {
            printf("Error al consultar la base de datos: <br> $mensaje .<br>");
            die();
        }
        finally
        {
            return $retorno;
        }  
    }

    public static function ImprimirArrayComoTabla($array)
    {
        if(sizeof($array) == 0 || $array == null)
        {
            print "\t<td>Sin datos disponibles.</td>\n";
            print "</tr>\n";
        }
        else
        { 
            foreach ($array as $fila) 
            {
                foreach ($fila as $columna) 
                {
                    if($columna == null)
                    {
                        print "\t<td>Sin datos disponibles.</td>\n";
                    }
                    else
                    {
                        print "\t<td>$columna</td>\n";
                    }
                    print "\t<td>$columna</td>\n";
                }
                print "</tr>\n";
            } 
        }       
    }
}

?>