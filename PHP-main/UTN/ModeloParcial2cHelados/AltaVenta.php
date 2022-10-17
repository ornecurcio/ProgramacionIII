<?php

include_once "Venta.php";
include_once "Producto.php";
include_once "GuardarLeerJson.php";
include_once "Toolkit.php";
include_once "Descuento.php";

$listaDeJSON = GuardarLeerJson::LeerJson("Heladeria.json");
$listaDeProductos=array();
$listaDeVentas = array();
$listadDeCupones = array();

if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $productoJson) 
    {
        $productoAuxiliar = new Producto($productoJson["_id"],
                                         $productoJson["_sabor"],
                                         $productoJson["_tipo"],
                                         $productoJson["_precio"],
                                         $productoJson["_stock"]);
        array_push($listaDeProductos,$productoAuxiliar);
    }
}
$listaDeJSON = GuardarLeerJson::LeerJson("Ventas.json");
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

$listaDeJSON = GuardarLeerJson::LeerJson("Cupones.json");
if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $cuponJson)
    {
        $cuponAuxiliar = new Descuento ($cuponJson["_id"],
                                        $cuponJson["_idPedido"],
                                        $cuponJson["_porcentajeDescuento"],
                                        $cuponJson["_usado"]);
        array_push($listadDeCupones,$cuponAuxiliar);
    }
}

$ventaCreada = CrearVenta($listaDeVentas,$listaDeProductos,
                        $_POST["mailUsuario"],
                        $_POST["sabor"],
                        $_POST["tipo"],
                        $_POST["cantidad"],
                        $_POST["numeroPedido"]);


if($ventaCreada!=null)
{
    if($ventaCreada->GuardarImagen())
    {
        if($listaDeVentas == null)
        {
            $listaDeVentas= array();
        }

        $productoPedido =Toolkit::BuscarProducto($listaDeProductos,$_POST["sabor"],$_POST["tipo"]);
        
        if($productoPedido !=null)
        {
            $cuponUtilizado = Toolkit::BuscarCupon($listadDeCupones,$_POST["idCupon"]);
            if($cuponUtilizado !=null)
            {
                $cuponUtilizado->usado = true;
                echo "Cupon utilizado";
            }
            $stockActualizado = $productoPedido->_stock - $_POST["cantidad"];
            if($stockActualizado>=0)
            {
                $productoPedido->_stock = $productoPedido->_stock - $_POST["cantidad"];
                echo "Venta creada con éxito";
                array_push($listaDeVentas,$ventaCreada);
                GuardarLeerJson::GrabarEnJson($listaDeVentas,"Ventas.json");
                GuardarLeerJson::GrabarEnJson($listaDeProductos,"Heladeria.json");
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

function CrearVenta($listaDeVentas,$listaDeProductos,$mailUsuario,$sabor,$tipo,$cantidad, $numeroDePedido)
{
    $productoPedido =Toolkit::BuscarProducto($listaDeProductos, $sabor, $tipo);
    if($productoPedido != null)
    {
        $ventaNueva = new Venta(Toolkit::ConseguirIDMaximo($listaDeVentas,100)+1,$mailUsuario,$sabor,$tipo,$cantidad,$numeroDePedido);
        return $ventaNueva;
    }
    return null;
}

?>