<?php

include "auto.php";
$ruta = "autos.csv";

$autoUno = new Auto("BMW", "Rojo");
$autoDos = new Auto("BMW", "Negro");

$autoTres = new Auto("VW", "Blanco", 10);
$autoCuatro = new Auto("VW", "Blanco", 20);

$autoCinco = new Auto("VW", "Verde", 80,new DateTime('2015-01-01')
);

//Auto::MostrarAuto($autoCinco);
$arrayDeAutos = [$autoUno, $autoDos, $autoTres, $autoCuatro, $autoCinco];

Auto::Add($autoUno, $autoDos);

if($autoUno->Equals($autoUno, $autoDos))
{
    printf("El auto uno y el auto dos son iguales. <br>");
}
else
{
    printf("El auto uno y el auto dos son distintos. <br>");

}

if($autoUno->Equals($autoUno, $autoCinco))
{
    printf("El auto uno y el auto cinco son iguales. <br>");
}
else
{
    printf("El auto uno y el auto cinco son distintos. <br>");
}

Auto::MostrarObjeto($autoUno);
Auto::MostrarObjeto($autoTres);
Auto::MostrarObjeto($autoCinco);

$arrayDeAutos = [$autoUno, $autoDos, $autoTres, $autoCuatro, $autoCinco];
//var_dump($arrayDeAutos);

Auto::GrabarArrayEnCsv($arrayDeAutos, $ruta);

//Auto::GrabarEnCsv($autoCinco, $ruta);

$arrayDeAutosDelCsv = Auto::LeerCsv($ruta);
//var_dump($arrayDeAutosDelCsv);
Auto::MostrarArrayDeObjetos($arrayDeAutosDelCsv);


?>