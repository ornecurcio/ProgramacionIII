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

    public static function BuscarCupon($listaDeCupones,$numero)
    {

        if(count($listaDeCupones)>0){
            foreach ($listaDeCupones as $cupon)
            {
                if($cupon->_id == $numero)
                {
                    return $cupon;
                }
            }
        }
        return null;
    }
    
    public static function ConseguirIDMaximo($lista,$numeroPartida)
    {
        $idMaxima = $numeroPartida;
        if(count($lista)>0)
        {
            foreach ($lista as $item)
            {
                if($item->_id > $idMaxima)
                {
                    $idMaxima =$item->_id;
                }
            }
        }
        return $idMaxima;     
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

    public static function BuscarProducto($listaDeProductos,$sabor,$tipo)
    {
        if(count($listaDeProductos)>0)
        {
            foreach ($listaDeProductos as $producto)
            {
                if((strcmp($producto->_sabor,$sabor)==0)&&(strcmp($producto->_tipo,$tipo)==0))
                {
                    return $producto;
                }
            }
        }
        return null;
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