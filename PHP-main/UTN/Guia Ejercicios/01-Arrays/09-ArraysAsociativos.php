<?php 
//Ornela Ivana Curcio
// Realizar las líneas de código necesarias para generar un Array asociativo $lapicera,
// que contenga como elementos: "‘"color’, "‘"marca’, "‘"trazo’ y "‘"precio’.
// Crear, cargar y mostrar tres lapiceras.
//======================================================================
$lapicera1= array(
    "color" => "Verde",
    "marca" => "Bic",
    "trazo" => "fino",
    "precio" => 25,);
    
$lapicera2= array(
        "color" => "Roja",
        "marca" => "Faber-Castell",
        "trazo" => "grueso",
        "precio" => 39,);
$lapicera3= array(
    "color" => "Azul",
    "marca" => "Marca China",
    "trazo" => "mediana",
    "precio" => 20,);
echo("-----Lapicera 1"); 
foreach($lapicera1 as $key => $value)
{
    echo($value . "<br>"); 
}
echo("-----Lapicera 2");
foreach($lapicera2 as $key => $value)
{
    echo($value . "<br>"); 
}
echo("-----Lapicera 3");
foreach($lapicera3 as $key => $value)
{
    echo($value . "<br>"); 
}
?>