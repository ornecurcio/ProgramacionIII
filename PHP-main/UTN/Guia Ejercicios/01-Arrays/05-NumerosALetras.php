<?php 
//======================================================================
//Ornela Ivana Curcio
// Realizar un programa que en base al valor numérico de la variable $num,
//  pueda mostrarse por pantalla el nombre del número que tenga dentro escrito con palabras,
//   para los números entre el 20 y el 60. 
//======================================================================

$num = 55;
$decena = (int)($num / 10);
$unidades = $num % 10;
$resultado = "";

switch($decena)
{
    case 2: 
        $resultado= "veinte"; 
        break; 
    case 3: 
        $resultado= "treinta"; 
        break; 
    case 4: 
        $resultado= "cuarenta"; 
        break; 
    case 5: 
        $resultado= "cincuenta"; 
        break; 
    case 6: 
        $resultado= "sesenta"; 
        break; 
}

switch($unidades)
{
    case 1: 
        $resultado= $resultado." y uno"; 
        break; 
    case 2: 
        $resultado= $resultado." y dos";
        break; 
    case 3: 
        $resultado= $resultado." y tres";
        break; 
    case 4: 
        $resultado= $resultado." y cuatro";
        break; 
    case 5: 
        $resultado= $resultado." y cinco";
        break; 
    case 6: 
        $resultado= $resultado." y seis";
        break; 
    case 7: 
        $resultado = $resultado. " y siete"; 
        break; 
    case 8: 
        $resultado = $resultado . " y ocho"; 
        break; 
    case 9: 
        $resultado = $resultado . " y nueve"; 
        break; 
}

echo("El numero ".$num." es: ".$resultado); 
?>