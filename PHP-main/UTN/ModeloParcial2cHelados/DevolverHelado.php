<?php

include_once "Venta.php";
include_once "Helado.php";
include_once "GuardarLeerJson.php";
include_once "Toolkit.php";
include_once "Descuento.php";

$listaDeVentas = array();
$listaDeDevoluciones = array();
$listaDeCupones = array();

$listaDeJSON = GuardarLeerJson::LeerJson("Ventas.json");
if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $ventaJson)
    {
        $ventaAuxiliar = new Venta (
                            $ventaJson["id"],
                            $ventaJson["mailUsuario"],
                            $ventaJson["sabor"],
                            $ventaJson["tipo"],
                            $ventaJson["cantidad"],
                            $ventaJson["numeroDePedido"],
                            $ventaJson["fechaDePedido"]);
        array_push($listaDeVentas,$ventaAuxiliar);
    }
}

$listaDeJSON = GuardarLeerJson::LeerJson("Cupones.json");
if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $cuponesJson)
    {
        $cuponAuxiliar = new Descuento (
                                        $cuponesJson["id"],
                                        $cuponesJson["idPedido"], 
                                        $cuponesJson["porcentajeDescuento"],
                                        $cuponesJson["usado"]);
        array_push($listaDeCupones,$cuponAuxiliar);
    }
}


$numeroDePedido = $_POST["numeroPedido"];
$causaDevolucion = $_POST["causa"];
$ventaBuscada = Toolkit::ConseguirObjetoPorId($numeroDePedido,$listaDeVentas);

if($ventaBuscada !=null)
{
    array_push($listaDeDevoluciones,$ventaBuscada);
    $cuponDescuento = new Descuento(Toolkit::ConseguirIDMaximo($listaDeCupones,100)+1,$numeroDePedido,10,false);
    echo "Cupon generado";
    array_push($listaDeCupones,$cuponDescuento);
}


GuardarLeerJson::GrabarEnJson($listaDeVentas,"Ventas.json");
GuardarLeerJson::GrabarEnJson($listaDeCupones,"Cupones.json");
GuardarLeerJson::GrabarEnJson($listaDeDevoluciones,"Devoluciones.json");


?>