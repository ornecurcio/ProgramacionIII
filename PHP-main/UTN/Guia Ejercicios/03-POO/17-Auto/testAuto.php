<?php
include "Auto.php";
//======================================================================
// Realizar una clase llamada ​“Auto”​ que posea los siguientes atributos ​privados​:
// _color (String)
// _precio (Double)
// _marca (String).
// _fecha (DateTime)
// Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
// i. La marca y el color.
// ii. La marca, color y el precio.
// iii. La marca, color, precio y fecha.
// Realizar un método de ​instancia​ llamado “​AgregarImpuestos”,​ que recibirá un doble por
// parámetro y que se sumará al precio del objeto.
// Realizar un método de ​clase​ llamado ​“MostrarAuto”,​ que recibirá un objeto de tipo ​“Auto”
// por parámetro y que mostrará todos los atributos de dicho objeto.
// Crear el método de instancia ​“Equals” ​que permita comparar dos objetos de tipo ​“Auto”​. Sólo
// devolverá ​TRUE​ si ambos ​“Autos”​ son de la misma marca.
// Crear un método de clase, llamado ​“Add”​ que permita sumar dos objetos ​“Auto”​ (sólo si son
// de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un ​Double​ con
// la suma de los precios o cero si no se pudo realizar la operación.
// Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
// En ​testAuto.php​:
// Crear ​dos​ objetos ​“Auto”​ de la misma marca y distinto color. #
// ● Crear ​dos​ objetos ​“Auto”​ de la misma marca, mismo color y distinto precio. #
// ● Crear ​un​ objeto ​“Auto”​ utilizando la sobrecarga restante. #
// ● Utilizar el método ​“AgregarImpuesto”​ en los últimos tres objetos, agregando $ 1500
// al atributo precio.
// ● Obtener el importe sumado del primer objeto ​“Auto”​ más el segundo y mostrar el
// resultado obtenido.
// ● Comparar el primer ​“Auto”​ con el segundo y quinto objeto e informar si son iguales o
// no.
// ● Utilizar el método de clase “​MostrarAuto​” para mostrar cada los objetos impares (1, 3,
// 5)
//======================================================================
    // Crear ​dos​ objetos ​“Auto”​ de la misma marca y distinto color. #
    $a1 = new Auto("Toyota","Verde");
    $a2 = new Auto("Toyota","Azul");
    // Crear ​dos​ objetos ​“Auto”​ de la misma marca, mismo color y distinto precio
    $a3 = new Auto("Ford","Rojo",450);
    $a4 = new Auto("Ford","Rojo",450);
    // Crear ​un​ objeto ​“Auto”​ utilizando la sobrecarga restante. #
    $a5 = new Auto("Fiat","Verde",125,date_create("2021-03-19"));

    $a3->AgregarImpuestos(1500);
    $a4->AgregarImpuestos(1500);
    $a5->AgregarImpuestos(1500);
    

    $arrayAutos = array();
    array_push($arrayAutos,$a1,$a2,$a3,$a4,$a5);    

    $impSumado = Auto::Add($a1,$a2);
    echo("<br/>El importe del auto 1+auto 2 es: " . $impSumado);
    if($a1->Equals($a2)){
        echo("<br/>Auto 1 = Auto 2");
    }
    else{
        echo("<br/>Auto 1 != Auto 2");
    }
    if($a1->Equals($a5)) {
        echo("<br/>Auto 1 = Auto 5");
    }
    else{
        echo("<br/>Auto 1 != Auto 5");
    }
    // foreach ($arrayAutos as $item) {
    //     
    // }
    for ($i=0; $i < count($arrayAutos); $i++) { 
        if($i % 2 == 1){
            echo(Auto::MostrarAuto($arrayAutos[$i]));
        }
    }
?>