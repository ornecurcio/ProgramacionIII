<?php
//======================================================================
// Confeccionar un programa que sume todos los numeros enteros desde 1
// mientras la suma no supere a 1000. Mostrar los numeros sumados
// y al finalizar el proceso indicar cuantos numeros se sumaron
//======================================================================


    #      variables      condicion  contador funcion   contadorvariable
    #for ($i = 1, $j = 0; $i <= 10; $j += $i, print $i, $i++); version abreviada
    #for ($i = 1, $j = 0; $j <= 1000; $j += $i, print $i, $i++); 
    // for($i = 1, $j = 0; $j <= 1000; $j += $i)
    // {
    //     echo $i. "+".$j."=".($i+$j);
    //     ?><br/>
    //     <?php
    //     $i++;
    // }

    $i=1; 
    $acumulador=0; 
    while($acumulador<=1000)
    {
        echo $i."+".$acumulador."=".($i+$acumulador)."<br/>";
        $acumulador = $i + $acumulador; 
        $i++; 
    }
    echo "Ls cantidad de numeros sumados es ".$i; 
?>
