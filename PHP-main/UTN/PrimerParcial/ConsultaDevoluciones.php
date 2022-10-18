<?php

include_once "Devolucion.php";
include_once "Producto.php";
include_once "GuardarLeerJson.php";
include_once "Toolkit.php";
include_once "Cupon.php"; 

$listaDeProductos = array();
$listaDeDevoluciones = array();
$listaDeCupones = array();
$listadoDeVentasPorTipo = array();
$listadoDeVentasPorNombre = array(); 

//a- Listar las devoluciones con cupones.
//b- Listar solo los cupones y su estado
//c- Listar devoluciones y sus cupones y si fueron usados

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
                                    $devolucionJson["fechaDePedido"],
                                    $devolucionJson["causa"]);

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

//- Listar las devoluciones con cupones.
echo "--------------------Listar devoluciones con cupones:---------------------------\n";

foreach ($listaDeCupones as $cupon)
{
    $devolucionAuxiliar = Toolkit::ConseguirObjetoPorId($cupon->idPedido, $listaDeDevoluciones); 
    $devolucionAuxiliar->Mostrar();
    echo "\n";
    $cupon->Mostrar();
    echo "\n";
    
}
//- Listar solo los cupones y su estado
echo "-------------------Listar devoluciones con :----------------------------------\n";

foreach ($listaDeCupones as $cupon)
{
    
    if($cupon->usado==true)
    {
        $cupon->Mostrar();
        echo" esta usado"; 
    }
    else
    {
        $cupon->Mostrar();
        echo" no esta usado"; 
    }
    echo "\n";
    
}
//c- Listar devoluciones y sus cupones y si fueron usados
echo "-------------------Listar devoluciones con cupones usados :--------------------\n";

foreach ($listaDeCupones as $cupon)
{
    
    if($cupon->usado==true)
    {
        $devolucionAuxiliar = Toolkit::ConseguirObjetoPorId($cupon->idPedido, $listaDeDevoluciones); 
        $devolucionAuxiliar->Mostrar();
        echo "\n";
        $cupon->Mostrar();

    }
    echo "\n";
    
}


?> 