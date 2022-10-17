<?php

include_once 'Producto.php';
include_once 'GuardarLeerJson.php';

$sabor = $_POST["sabor"];
$tipo = $_POST["tipo"];
$ruta = "Heladeria.json"; // OJO

$array = GuardarLeerJson::LeerJson($ruta);
$listaProductos = array();

if($array!=null &&count($array)>0)
{
    foreach ($array as $productoJson) 
    {
        $productoAuxiliar = new Producto($productoJson["_id"],
                                        $productoJson["_sabor"],
                                        $productoJson["_tipo"],
                                        $productoJson["_precio"],
                                        $productoJson["_stock"]);

        array_push($listaProductos,$productoAuxiliar);
    }
}

if(isset($sabor) && isset($tipo))
{
    $productoAux = new Producto(null, $sabor, $tipo, null, null); 
    if(Toolkit::BuscarProducto($listaProductos, $sabor, $tipo) != null)
    {
        printf("Sí hay :)");
    }
    else
    {
        if(Toolkit::ExisteUnValorEnArray($productoAux, $array, "_sabor"))
        {
            printf("Hay del mismo sabor. <br>");
        }
        else
        {
            printf("No hay del mismo sabor. <br>");
        }
    
        if(Toolkit::ExisteUnValorEnArray($productoAux, $array, "_tipo"))
        {
            printf("Hay del mismo tipo. <br>");
        }
        else
        {
            printf("No hay del mismo tipo. <br>");
        }
    }
}


?>