<?php 
//======================================================================
// Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 
// (hacer una función que las calcule invocando la función ​pow​).
//======================================================================

for ($i=1; $i <= 4; $i++) { 
    ?>
    <br/>
    <?php 
    for ($j=1; $j <= 4; $j++) {        
        echo(calculatePow($i,$j));
        ?><br/> 
        <?php 
    }
    
}
function calculatePow(int $n,int $p)
{
    return pow($n,$p);
}
?>