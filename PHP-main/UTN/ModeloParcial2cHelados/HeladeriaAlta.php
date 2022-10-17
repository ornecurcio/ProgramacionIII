<?php

include_once "Producto.php"; 
include_once "GuardarLeerJson.php"; 

$sabor =$_POST["sabor"];
$tipo = $_POST["tipo"];
$stock = $_POST["stock"];
$precio = $_POST["precio"];

$ruta = "Heladeria.json"; //OJO
$array = GuardarLeerJson::LeerJson($ruta);

if(isset($sabor) && isset($tipo) && isset($stock) && isset($precio))
{
    $productoAux = new Producto((Toolkit::ConseguirIDMaximo($array,1)+1),$sabor, $tipo, $precio, $stock);
    Producto::AltaModificacion($productoAux, $array, $ruta);
    printf("Producto grabado con éxito :) <br>");   
}
else
{
    printf("Ingrese todos los valores. <br>");   
}

?>