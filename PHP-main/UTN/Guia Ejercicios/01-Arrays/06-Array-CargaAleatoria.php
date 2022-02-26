<?php 
//======================================================================
// Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número
// (utilizar la función rand). 
// Mediante una estructura condicional, determinar si el promedio de los números son
// mayores, menores o iguales que 6.
// Mostrar un mensaje por pantalla informando el resultado.
//======================================================================

$aRandm= array();
// count($aRandm)
for ($i=0; $i < 5; $i++) { 
    array_push($aRandm,rand(1,100));
    echo("Numero [" . $i . "] = " . $aRandm[$i]);
}
$promedio = 0;
foreach ($aRandm as $item) {
    $promedio += $item;
}
$promedio /= count($aRandm);
if($promedio > 6)
{
    echo("El promedio de los numeros es mayor a 6");
}
elseif($promedio == 6)
{
    echo("El promedio de los numeros es igual a 6");
}
else{
    echo("El promedio de los numeros es menor a 6");
}
?>