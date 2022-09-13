<?php

include "usuario.php";

$nombre = $_GET["nombre"];
$clave = $_GET["clave"];
$mail = $_GET["mail"];
$metodo = $_SERVER ['REQUEST_METHOD'];
$ruta = "usuarios.csv"; 

$usuario = new Usuario($nombre, $clave, $mail);

switch($metodo)
{  
    case 'POST':
        break; 
    case 'GET':
        if(Usuario::GrabarEnCsv($usuario, $ruta))
        {
            Usuario::ImprimirCsv($ruta);
        }
        else
        {
            printf("Error generando el csv.");
        }  
        break; 

}

?>
