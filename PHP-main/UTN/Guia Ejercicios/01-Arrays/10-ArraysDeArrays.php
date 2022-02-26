<?php 
//======================================================================
// Realizar las líneas de código necesarias para generar un Array asociativo
// y otro indexado que contengan como elementos tres Arrays del punto anterior cada uno.
// Crear, cargar y mostrar los Arrays de Arrays.
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