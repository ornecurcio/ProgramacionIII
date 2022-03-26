<?php 
//======================================================================
// Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número
// (utilizar la función rand). 
// Mediante una estructura condicional, determinar si el promedio de los números son
// mayores, menores o iguales que 6.
// Mostrar un mensaje por pantalla informando el resultado.
//======================================================================

$arrayRandom= array();
$promedio = 0;
for ($i=0; $i < 5; $i++) { 
    array_push($arrayRandom,rand(-50,100));
    echo("Numero [" . $i . "] = " . $arrayRandom[$i]."<br>");
    $promedio+=$arrayRandom[$i];  
}

$promedio /= count($arrayRandom);
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