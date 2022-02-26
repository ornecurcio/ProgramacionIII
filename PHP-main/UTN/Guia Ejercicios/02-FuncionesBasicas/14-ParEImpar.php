<?php 
//======================================================================
// Crear una función llamada ​esPar​
// que reciba un valor entero como parámetro y devuelva ​TRUE si este número es par ó ​FALSE​ si es impar.
// Reutilizando el código anterior, crear la función ​esImpar​.
//======================================================================
$num = 2;  
    echo($num . " >>> ");   
    if(esPar($num))
    {
        echo("true");
    }
    else
    {
        echo("false");
    }
    ?><br/> 
    <?php 
function esPar(int $n)
{    
    return $n % 2 == 0;
}
function esImpar(int $n)
{
    return !esPar($n);
}
?>