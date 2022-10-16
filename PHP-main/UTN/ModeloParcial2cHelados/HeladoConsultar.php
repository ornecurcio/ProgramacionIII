<?php

include_once 'Producto.php';
include_once 'GuardarLeerJson.php';

$sabor = $_POST["sabor"];
$tipo = $_POST["tipo"];
$ruta = "Heladeria.json"; // OJO


$productoAux = new Producto($sabor, $tipo, null, null, null);
$array = GuardarLeerJson::LeerJson($ruta);

if(isset($sabor) && isset($tipo))
{
    if(Toolkit::ConsultaSiHayYCual($productoAux, $array) > -1)
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