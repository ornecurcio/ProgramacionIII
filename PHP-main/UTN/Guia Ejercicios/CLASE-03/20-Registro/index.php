<?php

include "usuario.php";

$nombre = $_POST["nombre"];
$clave = $_POST["clave"];
$mail = $_POST["mail"];
$metodo = $_SERVER ['REQUEST_METHOD'];
$ruta = "usuarios.csv"; 

$usuario = new Usuario($nombre, $clave, $mail);

switch($metodo)
{  
    case 'POST':
        if(Usuario::GrabarEnCsv($usuario, $ruta))
        {
            printf("Archivo guardado con éxito.");
        }
        else
        {
            printf("Error generando el csv.");
        }  
        break; 
}

?>