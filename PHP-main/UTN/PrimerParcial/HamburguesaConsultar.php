<?php

include_once "Producto.php";
include_once "GuardarLeerJson.php";
include_once "Toolkit.php";

$listaDeJSON = GuardarLeerJson::LeerJson("Hamburguesas.json");
$listaDeProductos=array();

if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $productoJson) 
    {
        $productoAux = new Producto($productoJson["id"],
                                    $productoJson["nombre"],
                                    $productoJson["precio"],
                                    $productoJson["tipo"],
                                    $productoJson["stock"]);

        array_push($listaDeProductos,$productoAux);
    }
}

if(Toolkit::BuscarProducto($listaDeProductos,$_POST["nombre"],$_POST["tipo"]))
{
    echo "Si hay :)";
}
else
{
    echo "No existe el nombre o el tipo";
}

?>