<?php
//======================================================================
// Dadas tres variables numéricas de tipo entero $a, $b y $c,
// realizar una aplicación que muestre:
// el contenido de aquella variable que contenga el valor que se encuentre en el medio de las 3
// variables.
// De no existir dicho valor, mostrar un mensaje que indique lo sucedido.
// Ejemplo 1: $a = 6; $b = 9; $c = 8; => se muestra 8.
// Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”
//======================================================================
$a = 111;
$b = 1;
$c = 111;
$array = array($a,$b,$c);
sort($array);
$repValues = false;
for ($i=0; $i < (count($array)); $i++) 
{
    for ($j=$i+1; $j < (count($array)); $j++) { 
        if($array[$i] == $array[$j])
        {
            echo($array[$i] . "\n" . $array[$j]);
            $repValues = true;
            break;
        }
    }
}
if(min($array) != max($array) && !$repValues)
{
    echo("valor medio es: \n");
    echo($array[floor((count($array)/2))]);
}
else
{
    echo("No existe valor medio");
}
?>