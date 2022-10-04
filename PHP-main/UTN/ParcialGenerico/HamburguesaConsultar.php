<?php

/**HamburguesaConsultar.php: (por POST)Se ingresa Nombre, Tipo, si coincide con algún registro del archivo
Hamburguesas.json, retornar “Si Hay”. De lo contrario informar si no existe el tipo o el nombre. */

include_once 'Hamburguesa.php';
include_once 'GuardarLeerJson.php';

$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$ruta = "Hamburguesas.json"; // OJO


$hamburguesaAux = new Hamburguesa($nombre, $tipo, null, null, null);
$array = GuardarLeerJson::LeerJson($ruta);

if(isset($nombre) && isset($tipo))
{
    if(Toolkit::ConsultaSiHayYCual($hamburguesaAux, $array) > -1)
    {
        printf("Sí hay :)");
    }
    else
    {
        if(Toolkit::ExisteUnValorEnArray($hamburguesaAux, $array, "_nombre"))
        {
            printf("Hay del mismo nombre. <br>");
        }
        else
        {
            printf("No hay del mismo nombre. <br>");
        }
    
        if(Toolkit::ExisteUnValorEnArray($hamburguesaAux, $array, "_tipo"))
        {
            printf("Hay del mismo tipo. <br>");
        }
        else
        {
            printf("No hay del mismo tipo. <br>");
        }
    }
}


?>