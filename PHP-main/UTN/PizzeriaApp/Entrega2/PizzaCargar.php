<?php

include_once 'Pizza.php';
include_once 'GuardarLeerJson.php';

$sabor = $_GET["sabor"];
$tipo = $_GET["tipo"];
$cantidad = $_GET["cantidad"];
$precio = $_GET["precio"];


$ruta = "Pizza.json";
$array = GuardarLeerJson::LeerJson($ruta);

if(isset($sabor) && isset($tipo) && isset($cantidad) && isset($precio))
{
    $productoAux = new Producto($sabor, $tipo, $precio, $cantidad);
    Producto::AltaModificacion($productoAux, $array, $ruta);
    printf("Producto grabado con éxito.<br>");   
}
else
{
    printf("Ingrese todos los valores. Conc## <br>");   
}

?>