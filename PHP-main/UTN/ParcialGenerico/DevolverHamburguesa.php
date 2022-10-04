<?php
include_once 'Cupon.php';
include_once 'Devolucion.php';

include_once 'GuardarLeerJson.php';

$idPedido = $_POST["idPedido"];
$causa = $_POST["causa"];
$archivo = $_FILES["archivo"]; 


if(isset($idPedido) && isset($causa))
{
    $devolucion = new Devolucion();
    $devolucion->id_pedido = $idPedido;
    $devolucion->causa = $causa;
    $devolucion->archivo = $archivo;


    if($devolucion->Alta())
    {
        printf("Devolución realizada con éxito. Cupón generado.");
    }
    else
    {
        printf("La devolución no ha podido realizarse. La venta no existe o ya ha sido anulada.");
    }
    
}

?>