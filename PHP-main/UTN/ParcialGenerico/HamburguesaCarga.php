<?php
/**HamburguesaCarga.php: (por POST) se ingresa Nombre, Precio, Tipo (“simple” o “doble”), Cantidad( de
unidades). Se guardan los datos en en el archivo de texto Hamburguesas.json, tomando un id autoincremental
como identificador(emulado) .Sí el nombre y tipo ya existen , se actualiza el precio y se suma al stock existente.
completar el alta con imagen de la hamburguesa, guardando la imagen con el tipo y el nombre como
identificación en la carpeta /ImagenesDeHamburguesas. */

include_once 'Hamburguesa.php';

$nombre =$_POST["nombre"];
$tipo = $_POST["tipo"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];
$archivo = $_FILES["archivo"]; 

$ruta = "Hamburguesas.json"; 
$array = GuardarLeerJson::LeerJson($ruta);

if(isset($nombre) && isset($tipo) && isset($cantidad) && isset($precio))
{
    $hamburguesaAux = new Hamburguesa($nombre, $tipo, $precio, $cantidad, $archivo);
    Hamburguesa::AltaModificacion($hamburguesaAux, $array, $ruta);
    printf("Hamburguesa grabado con éxito :) <br>");   
}
else
{
    printf("Ingrese todos los valores. <br>");   
}

?>