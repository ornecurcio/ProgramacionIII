<?php
require_once("Usuario.php");

if(isset($_POST['nombre']) &&
 isset($_POST['mail']) &&
 isset($_POST['clave'])) {    
     $fileName = 'usuarios.json';
    $nombre = $_POST['nombre'];
    $mail = $_POST['mail'];
    $clave = $_POST['clave'];
    $usuario = new Usuario($nombre,$mail,$clave,new DateTime("now"));
    $archivo = fopen($fileName,'a');
    fwrite($archivo,json_encode($usuario));
    if(fclose($archivo)){
        echo("<br/>Grabado con éxito! (PATH = $fileName)");
    }
    else{
        echo("<br/>No se pudo guardar el usuario (PATH = $fileName)");
    }
    //Debbugin mostrar el json
    $arrayJSON = [];    
    $archivo = fopen($fileName,'r');
    $fSize = filesize($fileName);    
    print_r(json_decode(fread($archivo,$fSize)));
    fclose($archivo);   
}
?>