<?php 
//======================================================================
// Cargar los tres arrays con los siguientes valores y luego ‘juntarlos’ en uno.
//  Luego mostrarlo por pantalla.
// “Perro”, “Gato”, “Ratón”, “Araña”, “Mosca”
// “1986”, “1996”, “2015”, “78”, “86”
// “php”, “mysql”, “html5”, “typescript”, “ajax”
// Para cargar los arrays utilizar la función array_push.
//  Para juntarlos, utilizar la función array_merge.
//======================================================================
$animales= array(
    "Perro",
    "Gato",
    "Raton",
    "Araña",
    "Mosca",);    
$años= array(
        "1986",
        "1996",
        "2015",
        "78",
        "86",);
$lenguajes= array(
    "php",
    "mysql",
    "html5",
    "typescript",
    "ajax",);
$info=array();
array_push($info,$animales,$años,$lenguajes);
foreach ($info as $arrayAux) {
    foreach($arrayAux as $item)
    {        echo($item);
        ?><br/>
        <?php 
    }
}
?>