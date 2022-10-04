<?php

include_once 'Venta.php';

$datos = json_decode(file_get_contents("php://input"), true);

$numPedido = $datos["pedido"];
$email = $datos["email"];
$nombre = $datos["nombre"];
$tipo = $datos["tipo"];
$cantidad = $datos["cantidad"];


if(isset($numPedido) && isset($email) && isset($nombre) && isset($tipo) && isset($cantidad))
{  
    Venta::Modificacion($numPedido, $email, $nombre, $tipo, $cantidad);
}

?>
