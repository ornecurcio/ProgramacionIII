<?php

include_once "Producto.php";
include_once "GuardarLeerJson.php";
include_once "Toolkit.php";

$listaDeJSON = GuardarLeerJson::LeerJson("Hamburguesas.json");
$listaDeProductos=array();
//$listaDeProductos = GuardarLeerJson::LeerJson("Hamburguesas.json");
if($listaDeJSON!=null &&count($listaDeJSON)>0)
{

    foreach ($listaDeJSON as $prodcutoJson) 
    {
        $productoAuxiliar = new Producto($prodcutoJson["id"],
                                         $prodcutoJson["nombre"],
                                         $prodcutoJson["precio"],
                                         $prodcutoJson["tipo"],
                                         $prodcutoJson["stock"]);

        array_push($listaDeProductos,$productoAuxiliar);
    }
}

if(Toolkit::BuscarProducto($listaDeProductos,$_POST["nombre"],$_POST["tipo"])==null)
{
    echo "El producto no existe se creará una nuevo\n";

    $productoNuevo = CrearProducto($listaDeProductos,$_POST["nombre"],
                                                    $_POST["precio"],
                                                    $_POST["tipo"],
                                                    $_POST["cantidad"]);
    if($productoNuevo==null)
    {
        echo "No se pudo cargar el producto, verificar los datos\n";
    }
    else
    {
        array_push($listaDeProductos,$productoNuevo);
    }        
}
else
{
    echo "El producto existe, actualizamos los datos\n";
    ActualizarProducto(Toolkit::BuscarProducto($listaDeProductos,$_POST["nombre"],
                                                                 $_POST["tipo"]),
                                                                 $_POST["precio"],
                                                                 $_POST["cantidad"]);
}
foreach ($listaDeProductos as $producto) 
{
    $producto->Mostrar();
    echo "\n";
}

/*--------------------------------------------------------*/
GuardarLeerJson::GrabarEnJson($listaDeProductos,"Hamburguesas.json");

function CrearProducto($listaDeProductos,$nombre,$precio,$tipo,$cantidad)
{
    $productoAuxiliar = new Producto(Toolkit::ConseguirIDMaximo($listaDeProductos,1000)+1,$nombre,$precio,$tipo,$cantidad);
    if($productoAuxiliar->GuardarImagen())
    {
        return $productoAuxiliar;
    }
   return null;
}


function ActualizarProducto($producto,$precio,$stock)
{
    $producto->precio = $precio;
    $producto->stock = $producto->stock + $stock;
}



?>