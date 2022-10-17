<?php
include_once "Venta.php";
include_once "Producto.php";
include_once "GuardarLeerJson.php";
include_once "Toolkit.php";

$listaDeProductos = array();
$listaDeVentas = array();
$listaDeVentasEntreFechas = array();
$listaDeVentasPorUsuario = array();
$listadoDeVentasPorTipo = array();
$listadoDeVentasPorNombre = array(); 
$fechaVenta = new DateTime($_GET["fechaVenta"]);
$fechaMinima = new DateTime($_GET["fechaMinima"]);
$fechaMaxima = new DateTime($_GET["fechaMaxima"]);
$cantidadProductosVendidos = 0;

$listaDeJSON = GuardarLeerJson::LeerJson("Hamburguesas.json");
//- La cantidad de Hamburguesas vendidas en un día en particular, 
//si no se pasa fecha, se muestran las del día de ayer.
//- El listado de ventas entre dos fechas ordenado por nombre.
//- El listado de ventas de un usuario ingresado.
//- El listado de ventas de un tipo ingresado.
//- El listado de ventas de un nombre ingresado.

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

        $fechaAuxiliar = new DateTime($ventaAuxiliar->fechaDePedido);

        if($fechaVenta==null)
        {
            /*- La cantidad de Hamburguesas vendidas en un día en particular, 
                 si no se pasa fecha, se muestran las del día de ayer.*/
            $fechaVenta = new DateTime("16-10-2022");//AYER
        }
        if($fechaVenta == $fechaAuxiliar)
        {
            $cantidadProductosVendidos+=$ventaAuxiliar->cantidad;
        }

        //- El listado de ventas de un usuario ingresado.
        if(strcmp($ventaAuxiliar->mailUsuario,$_GET["usuario"])==0)
        {
            array_push($listaDeVentasPorUsuario,$ventaAuxiliar);
        }

        //- El listado de ventas entre dos fechas ordenado por nombre.
        if($fechaMinima < $fechaAuxiliar && $fechaAuxiliar < $fechaMaxima)
        {
            array_push($listaDeVentasEntreFechas,$ventaAuxiliar);
        }
        //- El listado de ventas de un tipo ingresado.
        if(strcmp($ventaAuxiliar->tipo,$_GET["tipo"])==0)
        {
            array_push($listadoDeVentasPorTipo,$ventaAuxiliar);
        }
        //- El listado de ventas de un nombre ingresado.
        if(strcmp($ventaAuxiliar->nombre,$_GET["nombre"])==0)
        {
            array_push($listadoDeVentasPorNombre,$ventaAuxiliar);
        }

        array_push($listaDeVentas,$ventaAuxiliar);
    }
}

/* La cantidad de Hamburguesas vendidas en un día en particular, 
   si no se pasa fecha, se muestran las del día de ayer.*/
   $stringDate = $fechaVenta->format('d-m-Y');
echo "Se vendieron $cantidadProductosVendidos productos el día $stringDate\n";

 //- El listado de ventas de un usuario ingresado.
$usuario = $_GET["usuario"] ;
echo "El usuario $usuario realizó las siguientes ventas:\n";

foreach ($listaDeVentasPorUsuario as $item) 
{
    $item->Mostrar();
    echo "\n";
}

//- El listado de ventas entre dos fechas ordenado por nombre.
echo "------------------------------Ventas por fecha:---------------------------------------\n";

usort($listaDeVentasEntreFechas,"Toolkit::CompararNombres");
foreach ($listaDeVentasEntreFechas as $item) 
{
   $item->Mostrar();
   echo "\n";
}

//- El listado de ventas de un tipo ingresado.
 echo "------------------------------Ventas por tipo:--------------------------------------\n";
 foreach ($listadoDeVentasPorTipo as $item) 
 {
    $item->Mostrar();
    echo "\n";
 }

//- El listado de ventas de un nombre ingresado.
 echo "-----------------------------Ventas por nombre:--------------------------------------\n";
 foreach ($listadoDeVentasPorTipo as $item) 
 {
    $item->Mostrar();
    echo "\n";
 }

?>