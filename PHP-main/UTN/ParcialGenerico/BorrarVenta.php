<?php

include_once 'Venta.php';

$datos = json_decode(file_get_contents("php://input"), true);

$id = $datos["id"];

if(isset($id))
{  
    if(Venta::Borrar($id))
    {
        printf("Borrado con éxito.");
    }
    else
    {
        printf("No se ha podido borrar.");
    }
}

//PARA PROBAR
/* {
    "id": 1
 } */

?>