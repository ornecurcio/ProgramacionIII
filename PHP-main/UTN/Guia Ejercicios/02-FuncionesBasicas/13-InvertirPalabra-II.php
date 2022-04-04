<?php 
//Ornela Ivana Curcio
// Crear una función que reciba como parámetro un string (​$palabra​) y un entero (​$max​).
// La función validará que la cantidad de caracteres que tiene ​$palabra​ no supere a ​$max​
// y además deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
// “Recuperatorio”, “Parcial” y “Programacion”.
// Los valores de retorno serán:
// 1 si la palabra pertenece a algún elemento del listado.
// 0 en caso contrario
//======================================================================
function ValidString($s,$max)
{
    if(is_string($s)&& is_numeric($max))
    {
        if(str_word_count($s) < $max && 
        ($s == "Recuperatorio" || $s == "Parcial" || $s == "Programacion" ))
      {
        return 1;
      }
    }
        return 0;
}
$string = "Mariano";  
    echo($string . " >>> "); 
$ret = validString($string,13);

if(validString($string,13)==0)
{
    echo("no esta en el listado");
}
else
{
    echo("si esta en el listado");
}
?>