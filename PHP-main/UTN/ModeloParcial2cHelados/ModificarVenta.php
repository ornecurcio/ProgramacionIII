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
        $ventaAuxiliar = new Venta ($ventaJson["_id"],
                                    $ventaJson["_mailUsuario"],
                                    $ventaJson["_sabor"],
                                    $ventaJson["_tipo"],
                                    $ventaJson["_cantidad"],
                                    $ventaJson["_numeroDePedido"],
                                    $ventaJson["_fechaDePedido"]);
        array_push($listaDeVentas,$ventaAuxiliar);
    }
}

foreach ($listaDeVentas as $venta ) 
{
    if(strcmp($venta->_numeroDePedido,$datos["numeroDePedido"])==0 &&
        strcmp($venta->_mailUsuario,$datos["mailUsuario"])==0 )
    {
        var_dump($venta); 
        echo "Antes de cambiar\n";
        //$venta->Mostrar();
        $venta->_sabor = $datos["sabor"];
        $venta->_tipo = $datos["tipo"];
        $venta->_cantidad = $datos["cantidad"];
        echo "Se modificó la venta\n";
        $venta->Mostrar();
    }
}

GuardarLeerJson::GrabarEnJson($listaDeVentas,"Ventas.json");


?>