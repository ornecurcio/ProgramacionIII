<?php

include_once "Venta.php";
include_once "Producto.php";
include_once "GuardarLeerJson.php";
include_once "Toolkit.php";
include_once "Cupon.php";
include_once "Devolucion.php"; 

$listaDeVentas = array();
$listaDeDevoluciones = array();
$listaDeCupones = array();

$listaDeJSON = GuardarLeerJson::LeerJson("Ventas.json");
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
$listaDeJSON = GuardarLeerJson::LeerJson("Devoluciones.json");
if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $devolucionJson)
    {
        $devolucionAuxiliar = new Devolucion ($devolucionJson["id"],
                                    $devolucionJson["mailUsuario"],
                                    $devolucionJson["nombre"],
                                    $devolucionJson["tipo"],
                                    $devolucionJson["cantidad"],
                                    $devolucionJson["numeroDePedido"],
                                    $devolucionJson["fechaDePedido"]);

        array_push($listaDeDevoluciones,$devolucionAuxiliar);
    }
}

$listaDeJSON = GuardarLeerJson::LeerJson("Cupones.json");
if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $cuponesJson)
    {
        $cuponAuxiliar = new Cupon ($cuponesJson["id"],
                                    $cuponesJson["idPedido"], 
                                    $cuponesJson["porcentajeDescuento"],
                                    $cuponesJson["usado"]);

        array_push($listaDeCupones,$cuponAuxiliar);
    }
}


$numeroDePedido = $_POST["numeroDePedido"];
$causaDevolucion = $_POST["causa"];
$ventaBuscada = Toolkit::BuscarVenta($listaDeVentas,$numeroDePedido);

if($ventaBuscada !=null)
{
    array_push($listaDeDevoluciones,$ventaBuscada);
    $cuponDescuento = new Cupon (Toolkit::ConseguirIDMaximo($listaDeCupones,100)+1,
                                                            $numeroDePedido,
                                                            10,
                                                            false);
    echo "Cupon generado";
    array_push($listaDeCupones,$cuponDescuento);
}


GuardarLeerJson::GrabarEnJson($listaDeVentas,"Ventas.json");
GuardarLeerJson::GrabarEnJson($listaDeCupones,"Cupones.json");
GuardarLeerJson::GrabarEnJson($listaDeDevoluciones,"Devoluciones.json");


?>