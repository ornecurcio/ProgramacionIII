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

for ($i=0; $i < count($listaDeVentas); $i++) 
{ 
    if(strcmp($listaDeVentas[$i]->numeroDePedido,$datos["numeroDePedido"])==0)
    {
        $listaDeVentas[$i]->estaBorrada = true;
        MoverFoto($listaDeVentas[$i]);
        break;
    }
}

function MoverFoto($venta)
{
    $nombreMailFiltrado = explode("@",$venta->mailUsuario);       
    $nombreDeArchivo = "$venta->tipo - $venta->nombre - $nombreMailFiltrado[0]@";
    echo $nombreDeArchivo;
    $antiguaCarpeta = ".".DIRECTORY_SEPARATOR."ImagenesDeLaVenta".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
    $nuevaCarpeta = ".".DIRECTORY_SEPARATOR."BACKUPVENTAS".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
    if(!file_exists($nuevaCarpeta)) 
    {
        mkdir($nuevaCarpeta, 0777, true);
    }
    rename($antiguaCarpeta.$nombreDeArchivo.".jpg",$nuevaCarpeta.$nombreDeArchivo.".jpg");
}

GuardarLeerJson::GrabarEnJson($listaDeVentas,"Ventas.json");
?>