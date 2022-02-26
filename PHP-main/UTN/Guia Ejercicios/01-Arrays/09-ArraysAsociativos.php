<?php 
//======================================================================
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
$lapiceras=array();
array_push($lapiceras,$lapicera1,$lapicera2,$lapicera3);
foreach ($lapiceras as $arrayAux) {
    foreach($arrayAux as $key => $value)
    {
        echo($value);
        ?><br/>
        <?php 
    }
}
?>