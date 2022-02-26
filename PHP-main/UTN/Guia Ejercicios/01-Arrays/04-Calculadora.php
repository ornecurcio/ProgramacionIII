<?php
//======================================================================
// Escribir un programa que use la variable $operador 
//que pueda almacenar los símbolos matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; 
//y definir dos variables enteras $op1 y $op2.
// De acuerdo al símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
// resultado por pantalla.
//======================================================================

$operador = '';
$resul;
$op1 = 2;
$op2 = 5;
switch ($operador) {
    case '+':
        $resul = $op1+$op2;
        break;
    case '-':
        $resul = $op1-$op2;
        break;
    case '*':
        $resul = $op1*$op2;
        break;
    case '/':
        $resul = $op1/$op2;
        break;
    default:
        $resul = "Operador invalido";
        break;
}
echo($resul);
?>