<?php
include_once "Venta.php";
include_once "Producto.php";
include_once "GuardarLeerJson.php";
include_once "Toolkit.php";
include_once "Cupon.php";

$listaDeJSON = GuardarLeerJson::LeerJson("Hamburguesas.json");
$listaDeProductos=array();
$listaDeVentas = array();
$listadDeCupones = array();

if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $productoJson) 
    {
        $productoAuxiliar = new Producto($productoJson["id"],
                                         $productoJson["nombre"],
                                         $productoJson["precio"],
                                         $productoJson["tipo"],
                                         $productoJson["stock"]);

        array_push($listaDeProductos,$productoAuxiliar);
    }
}

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

$listaDeJSON = GuardarLeerJson::LeerJson("Cupones.json");
if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $cuponJson)
    {
        $cuponAuxiliar = new Cupon ($cuponJson["id"],
                                        $cuponJson["idPedido"],
                                        $cuponJson["porcentajeDescuento"],
                                        $cuponJson["usado"]);

        array_push($listadDeCupones,$cuponAuxiliar);
    }
}
$cuponUtilizado = Toolkit::BuscarCupon($listadDeCupones,$_POST["cuponDescuento"]);
if($cuponUtilizado !=null)
{
    $ventaCreada = CrearVenta($listaDeVentas,$listaDeProductos,$_POST["mailUsuario"],
    $_POST["nombre"],
    $_POST["tipo"],
    $_POST["cantidad"],
    $_POST["numeroDePedido"]);

    if($ventaCreada!=null)
    {
        if($ventaCreada->GuardarImagen())
        {
            if($listaDeVentas == null)
            {
                $listaDeVentas= array();
            }
            $productoElegido = Toolkit::BuscarProducto($listaDeProductos,$_POST["nombre"],$_POST["tipo"]);
            if($productoElegido !=null)
            {
                $stockActualizado = $productoElegido->stock - $_POST["cantidad"];
                if($stockActualizado>=0)
                {
                    $productoElegido->stock = $productoElegido->stock - $_POST["cantidad"];
                    $cuponUtilizado->usado = true;
                    $ventaCreada->precioTotal = $productoElegido->precio *  $_POST["cantidad"];
                    $ventaCreada->descuento = ($productoElegido->precio *  $_POST["cantidad"]) * 0.1; 
                    echo "Cupon utilizado. Importe total: $ventaCreada->precioTotal, Descuento:$ventaCreada->descuento\n";
                    echo "Venta creada con éxito\n";
                    array_push($listaDeVentas,$ventaCreada);
                    GuardarLeerJson::GrabarEnJson($listaDeVentas,"Ventas.json");
                    GuardarLeerJson::GrabarEnJson($listaDeProductos,"Hamburguesas.json");
                    GuardarLeerJson::GrabarEnJson($listadDeCupones,"Cupones.json");
                }
                else
                {
                    echo "No hay más disponibilidad";
                }
            }
        }
    }
    else
    {
        echo "No se pudo crear la venta. Revisar los datos\n";
    }
}
else
{
    echo "Cupón no valido";
}

function CrearVenta($listaDeVentas,$listaDeProductos,$mailUsuario,$nombre,$tipo,$cantidad, $numeroDePedido)
{
    $productoElegido =Toolkit::BuscarProducto($listaDeProductos,$nombre,$tipo);
    if($productoElegido != null)
    {
        $ventaNueva = new Venta(Toolkit::ConseguirIDMaximo($listaDeVentas,0)+1,$mailUsuario,$nombre,$tipo,$cantidad,$numeroDePedido);
        return $ventaNueva;
    }
    return null;
}

?>