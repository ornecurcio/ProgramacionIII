<?php
require_once("Usuario.php");
$nombre = $_POST['nombre'];
$mail = $_POST['mail'];
$clave = $_POST['clave'];
$usuario = new Usuario($nombre,$mail,$clave);
echo("Se guardaran los siguientes datos en el archivo usuarios.csv: ".$usuario->MostrarDatos());
if(Usuario::SaveFile($usuario->MostrarDatos(),"usuarios",true))
    echo("<br/>Se han guardado con exito los datos en el archivo");
else
    echo("<br/>No se han guardar los datos en el archivo");

?>