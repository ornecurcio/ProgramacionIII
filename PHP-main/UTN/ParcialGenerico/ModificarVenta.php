<?php

include_once "GuardarLeerJson.php";
include_once "Venta.php";

$listaDeVentas = array();
$listaDeJSON = GuardarLeerJson::LeerJson("Ventas.json");

$datos = json_decode(file_get_contents("php://input"), true);

if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $ventaJson)
    {
        $ventaAuxiliar = new Venta ($ventaJson["id"],
                                    $ventaJson["mailUsuario"],
                                    $ventaJson["nombre"],
                                    $ventaJson["tipo"],
                                    $ventaJson["cantidad"],
                                    $ventaJson["numeroDePedido"],
                                    $ventaJson["fechaDePedido"]);

        array_push($listaDeVentas,$ventaAuxiliar);
    }
}

foreach ($listaDeVentas as $venta ) 
{
    if(strcmp($venta->numeroDePedido,$datos["numeroDePedido"])==0 &&
       strcmp($venta->mailUsuario,$datos["mailUsuario"])==0 )
    {
        echo "Antes de cambiar\n";
        $venta->Mostrar();
        $venta->nombre = $datos["nombre"];
        $venta->tipo = $datos["tipo"];
        $venta->cantidad = $datos["cantidad"];
        echo "\nSe modificó la venta\n";
        $venta->Mostrar();
    }
}

GuardarLeerJson::GrabarEnJson($listaDeVentas,"Ventas.json");


?>