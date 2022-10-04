<?php

include 'Usuario.php';

$metodo = $_SERVER ['REQUEST_METHOD'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
var_dump($metodo);

switch ($metodo) {
    case 'GET':
        $myArray = Usuario::ReadJSON();
        //var_dump($myArray);
        Usuario::ImprimirInfoUsuarios($myArray);
        break;
}
?>