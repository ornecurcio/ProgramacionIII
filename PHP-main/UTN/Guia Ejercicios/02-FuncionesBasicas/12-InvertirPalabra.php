<?php 
//Ornela Ivana Curcio 
// Realizar el desarrollo de una función que reciba un Array de caracteres 
// y que invierta el orden de las letras del Array.
// Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
//======================================================================
function ReverseArray($arrayChar) 
{
     $arrayReverse = array_reverse($arrayChar);
     return $arrayReverse;
}

$arrayNombre = array('O','R','N','E','L','A');  
foreach($arrayNombre as $char)
{        
     echo($char); 
}
     echo( " >>> ");   

$arrayReverso = ReverseArray($arrayNombre);
foreach($arrayReverso as $c)
{
     echo($c);
}

?>