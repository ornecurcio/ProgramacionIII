
//======================================================================
// Confeccionar un programa que sume todos los numeros enteros desde 1
// mientras la suma no supere a 1000. Mostrar los numeros sumados
// y al finalizar el proceso indicar cuantos numeros se sumaron
//======================================================================

<?php
    #      variables      condicion  contador funcion   contadorvariable
    #for ($i = 1, $j = 0; $i <= 10; $j += $i, print $i, $i++); version abreviada
    #for ($i = 1, $j = 0; $j <= 1000; $j += $i, print $i, $i++); 
    for($i = 1, $j = 0; $j <= 1000; $j += $i)
    {
        print $i;
        ?><br/>
        <?php
        $i++;
    }
?>
