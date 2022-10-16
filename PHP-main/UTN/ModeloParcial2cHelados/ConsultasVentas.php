<?php

include_once 'Producto.php';
include_once 'Venta.php';
include_once 'Usuario.php';
include_once 'GuardarLeerJson.php';
include_once 'Toolkit.php';

$rutaProductos = "Heladeria.json"; 
$rutaUsuarios = "Usuarios.json";
$rutaVentas = "Ventas.json";

$arrayVentas =  GuardarLeerJson::LeerJson($rutaVentas); 
$arrayProductos = GuardarLeerJson::LeerJson($rutaProductos); 
$arrayUsuarios = GuardarLeerJson::LeerJson($rutaUsuarios);


//a-La cantidad de Helados vendidos en un día en particular(se envía por parámetro), 
//si no se pasa fecha, semuestran las del día de ayer.

if(isset($_GET["fechaVenta"]))
{
    $fechaVenta = $_GET["fechaVenta"];
}
else
{
    //AYER
    //$fecha = new DateTime("");
    //$fechaVenta->add(DateInterval::createFromDateString('yesterday'));
    // HOY
    //$fecha = new DateTime("now");
    //$fechaVenta = $fecha->format("Y-m-d");
    $fechaVenta = new DateTime("2022-10-16"); 
}
$cantidadHelados = 0;
foreach ($arrayVentas as $venta)
{
    $fechaAux = Toolkit::SacarValorDeClave($venta, "_fecha"); 
    $date = Toolkit::SacarValorDeClave($fechaAux, "date"); 
    $fechaFormato = new DateTime($date);
    $fechaSimple =$fechaFormato->format('Y-m-d'); 

    if($fechaSimple == $fechaVenta)
    {
        $cantidad = Toolkit::SacarValorDeClave($venta, "_cantidad");
        $cantidadHelados += $cantidad;
    }
}
echo "<br> A-La cantidad de ventas el dia ".$fechaVenta." es ".$cantidadHelados."<br>"; 


// b- el listado de ventas entre dos fechas ordenado por nombre.

if(isset($_GET["fechaMinima"]) && isset($_GET["fechaMaxima"]))
{
    $fechaMinima = $_GET["fechaMinima"];
    $fechaMaxima = $_GET["fechaMaxima"];
}
echo "B- El listado de ventas entre ".$fechaMinima." y ".$fechaMaxima."<br>"; 
$arrayVentaEntreFechas = array(); 
foreach ($arrayVentas as $venta)
{
    $fechaAux = Toolkit::SacarValorDeClave($venta, "_fecha"); 
    $date = Toolkit::SacarValorDeClave($fechaAux, "date"); 
    $fechaFormato = new DateTime($date);
    $fechaSimple =$fechaFormato->format('Y-m-d'); 

    //var_dump($venta); 
    if($fechaSimple < $fechaAux && $fechaSimple < $fechaMaxima)
    {
        $usuario = Toolkit::SacarValorDeClave($venta, "_usuario"); 
        $producto = Toolkit::SacarValorDeClave($venta, "_producto");
        $email = Toolkit::SacarValorDeClave($usuario, "_email"); 
        $sabor = Toolkit::SacarValorDeClave($producto, "_sabor");
        $tipo = Toolkit::SacarValorDeClave($producto, "_tipo");
        $cantidad = Toolkit::SacarValorDeClave($venta, "_cantidad"); 
        $id = Toolkit::SacarValorDeClave($venta, "_id");
        echo $id.", ".$email.", ".$sabor.", ".$tipo.", ".$cantidad.", ".$fechaSimple."<br>";
        
    } 
}


// // c- el listado de ventas de un usuario ingresado
// if(isset($_GET["usuario"]))
// {
//     $usuario = $_GET["usuario"];
//     echo "C-Listado de ventas de ".$usuario."<br>"; 
//     foreach($arrayVentas as $venta)
//     {
//         $usuarioAux = Toolkit::SacarValorDeClave($venta, "_usuario"); 
//         if($usuarioAux == $usuario)
//         {
//             $venta->MostrarDatos(); 
//         }
//     }
    
// }

// // d- - El listado de ventas por sabor ingresado.
// if(isset($_GET["sabor"]))
// {
//     $tipo = $_GET["sabor"];
//     echo "D-El listado de ventas de ".$sabor."<br>"; 
//     foreach($arrayVentas as $venta)
//     {
//         $productoAux = Toolkit::SacarValorDeClave($venta, "_producto"); 
//         $saborAux = Toolkit::SacarValorDeClave($productoAux, "_sabor"); 
//         if($saborAux == $sabor)
//         {
//             $venta->MostrarDatos(); 
//         }
//     }
   
// }

?>