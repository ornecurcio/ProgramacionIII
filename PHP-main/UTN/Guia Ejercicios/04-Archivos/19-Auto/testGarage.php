<?php
include_once "Garage.php";
include_once "Auto.php";
//======================================================================
// // Crear la clase ​Garage​ que posea como atributos privados:
// // _razonSocial (String)
// // _precioPorHora (Double)
// // _autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
// // Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
// // i. La razón social.
// // ii. La razón social, y el precio por hora.
// // Realizar un método de ​instancia​ llamado ​“MostrarGarage”,​ 
// // que no recibirá parámetros y que mostrará todos los atributos del objeto.
// // Crear el método de instancia ​“Equals”
// // ​que permita comparar al objeto de tipo ​Garaje​ con un objeto de tipo ​Auto.​
// // Sólo devolverá ​TRUE​ si el auto está en el garaje.
// // Crear el método de instancia ​“Add” ​para que permita sumar un objeto ​“Auto”​ al ​“Garage”
// // (sólo si el auto ​no​ está en el garaje, de lo contrario informarlo).
// // Ejemplo: $miGarage->Add($autoUno);
// // Crear el método de instancia ​“Remove” ​para que permita quitar un objeto ​“Auto”​ del “Garage”​ 
// // (sólo si el auto ​está​ en el garaje, de lo contrario informarlo).
// Ejemplo: $miGarage->Remove($autoUno);
// En ​testGarage.php​, crear autos y un garage.
// Probar el buen funcionamiento de todos los métodos.
//======================================================================

$garage = new Garage("SRL garage",300);
$a1 = new Auto("Renault", "Azul", 500000, "2021-03-28");
echo("Auto1: ".Auto::MostrarAuto($a1)); 
$a2 = new Auto("Citroen", "Negro", 1000000);
echo("Auto2: ".Auto::MostrarAuto($a2)); 
$a3 = new Auto("Ford", "Azul");
echo("Auto3: ".Auto::MostrarAuto($a3)); 

$garage->Add($a1);
$garage->Add($a1); //Repetido
$garage->Add($a2);
$garage->Add($a3);

echo("<br/>------Muestro el GARAGE------<br/>");

echo $garage->MostrarGarage();

// echo("<br/>------Saco un AUTO------<br/>");
// if($garage->Remove($a2))//El auto  está en el garage.
// {       
//     echo("Elemento removido");
// }
// else
// {
//     echo("No existe el elemento a eliminar");
// } 

// echo("<br/>------Muestro el GARAGE------<br/>");
// echo $garage->MostrarGarage(); 

// echo("<br/>------Intenso sacar un auto que no esta------<br/>");
// if($garage->Remove($a2))
// {       //El auto no está en el garage.
//     echo("Elemento fue removido");
// } 
// else
// {
//     echo("No existe el elemento a eliminar");
// }
// echo("<br/>------Muestro el GARAGE------<br/>");
// echo $garage->MostrarGarage();
// echo("<br/>------Agrego de nuevo un AUTO------<br/>");
// $garage->Add($a2);
// echo $garage->MostrarGarage();
// echo "================================TODO OK==============================="; 

$garage2 = new Garage("Furro garage",400);
$a10 = new Auto("Renault", "Blanco", 500000, "2021-03-28");
echo("Auto1: ".Auto::MostrarAuto($a10)); 
$a20 = new Auto("Ford", "Negro", 1000000);
echo("Auto2: ".Auto::MostrarAuto($a20)); 
$a30 = new Auto("Chevrolet", "Azul");
echo("Auto3: ".Auto::MostrarAuto($a30)); 

$garage2->Add($a10);
$garage2->Add($a20);
$garage2->Add($a30);

echo("<br/>------Muestro el GARAGE------<br/>");

echo $garage2->MostrarGarage();

$garages = array($garage, $garage2);

echo "================================Escribir===============================";
//var_dump($garage);
Garage::EscribirGarage($garage);
echo "================================Leer===============================";
Garage::LeerGarage(); 
?>
