<?php

class Toolkit
{
    public static function ConseguirIDMaximo($lista,$numeroPartida)
    {
        $idMaxima = $numeroPartida;
        if(count($lista)>0)
        {
            foreach ($lista as $item)
            {
                if($item->id > $idMaxima)
                {
                    $idMaxima =$item->id;
                }
            }
        }
        return $idMaxima;     
    }

    public static function BuscarCupon($listaDeCupones,$numero)
    {
        if(count($listaDeCupones)>0)
        {
            foreach ($listaDeCupones as $cupon)
            {
                if($cupon->id == $numero && $cupon->usado==false)
                {
                    return $cupon;
                }
            }
        }
        return null;
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

    public static function BuscarProducto($listaDeProductos,$nombre,$tipo)
    {
        if(count($listaDeProductos)>0)
        {
            foreach ($listaDeProductos as $producto)
            {
                if((strcmp($producto->nombre,$nombre)==0)&&(strcmp($producto->tipo,$tipo)==0))
                {
                    return $producto;
                }
            }
        }
        return null;
    }
    
    public static function ConseguirObjetoPorId($id, $array)
    {
        $retorno = null;

        foreach($array as $item)
        {
            $idAux = Toolkit::SacarValorDeClave($item, "numeroDePedido");
            if($idAux == $id)
            {
                $retorno = $item;
                break;
            }
        }
        return $retorno;
    }

    public static function BuscarVenta($listaDeVentas,$numero)
    {

        if(count($listaDeVentas)>0){
            foreach ($listaDeVentas as $venta)
            {
                if($venta->numeroDePedido == $numero)
                {
                    return $venta;
                }
            }
        }
        return null;
    }

    public static function CompararNombres($ventaUno, $ventaDos)
    {
        return strcmp($ventaUno->nombre, $ventaDos->nombre);
    }

    // public static function ConsultaSiHayYCual($item, $array)
    // {   
    //     $retorno = -1;

    //     for($i = 0 ; $i < sizeof($array) ; $i++)
    //     {         
    //         if($item->Equals($array[$i], $item))
    //         {
    //             $retorno = $i;
    //             break;
    //         }
    //     }
    //     return $retorno;
    // }

    // public static function ConseguirIdPorElIndex($item, $array)
    // {
    //     $retorno = -1;

    //     $indice = Toolkit::ConsultaSiHayYCual($item, $array);

    //     if($indice > -1)
    //     {
    //         $retorno = Toolkit::SacarValorDeClave($array[$indice], "id");
    //     }

    //     return $retorno;
    // }
    // public static function ExisteUnValorEnArray($item, $array, $clave)
    // {
    //     $retorno = false;
    //     $valorItem = Toolkit::SacarValorDeClave($item, $clave);

    //     foreach($array as $aux)
    //     {
    //         $valorAux = Toolkit::SacarValorDeClave($aux, $clave);

    //         if($valorAux == $valorItem)
    //         {
    //             $retorno = true;
    //             break;       
    //         }
    //     }
    //     return $retorno;
    // }

    // public static function AsignarId($item, $array)
    // {
    //     $idMasAlto = 0;  

    //     if(sizeof($array) > 0)
    //     {                    
    //         foreach($array as $auxItem)
    //         {          
    //             $id = Toolkit::SacarValorDeClave($auxItem, "id");
            
    //             if($id >= $idMasAlto)
    //             {
    //                 $idMasAlto = $id;
    //             }
    //         }
    //     }    
    //     $item->_id = $idMasAlto + 1;
    // }

}

?>