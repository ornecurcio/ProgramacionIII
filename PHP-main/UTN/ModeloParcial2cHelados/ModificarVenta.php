<?php

include_once 'Venta.php';

$datos = json_decode(file_get_contents("php://input"), true);

$numPedido = $datos["pedido"];
$email = $datos["email"];
$sabor = $datos["sabor"];
$tipo = $datos["tipo"];
$cantidad = $datos["cantidad"];

if(isset($numPedido) && isset($email) && isset($sabor) && isset($tipo) && isset($cantidad))
{  
    Venta::Modificacion($numPedido, $email, $sabor, $tipo, $cantidad);
}

//PARA PROBAR
/* 
{
    "pedido": 1,
    "email": "rus@rus.com",
    "sabor": "calabresa",
    "tipo": "molde",
    "cantidad": 9
} */

?>