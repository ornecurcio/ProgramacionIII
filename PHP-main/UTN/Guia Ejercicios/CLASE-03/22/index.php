<?php

include "usuario.php";

$clave = $_POST["clave"];
$mail = $_POST["mail"];
$metodo = $_SERVER ['REQUEST_METHOD'];
$ruta = "usuarios.csv"; 

$usuario = new Usuario($clave, $mail);

switch($metodo)
{  
    case 'POST':

        $usuario->Login($ruta, $usuario);
        break; 
}

?>