<?php 
//======================================================================
// Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
// Luego imprimir (utilizando la estructura for) cada uno en una línea distinta 
// (recordar que el salto de línea en HTML es la etiqueta <br/>).
//  Repetir la impresión de los números utilizando las estructuras while y foreach.
//======================================================================
$arrayEnteros = array();
$lenArray = 10;
for ($i=1; count($arrayEnteros) < $lenArray; $i++) { 
    if($i % 2 == 1)
    {
        array_push($arrayEnteros,$i);
        ?><br/>
        <?php
        echo($i);
    }
}
?>