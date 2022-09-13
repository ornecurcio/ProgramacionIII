<?php
    require 'Garage.php';
    
    $garage = new Garage("Garage Ornelita");
    $auto1 = new Auto("Renault", "R9", "Azul", "24/02/1989");
    $auto2 = new Auto("Renault", "R12", "Rojo", "09/12/1960");
    $auto3 = new Auto("Renault", "Megane", "Negro", "03/06/1960");

    $addFirstCar = $garage->Add($auto1);
    $addSecondCar = $garage->Add($auto2);
    $addThirdCar = $garage->Add($auto3);
    $addRepeatThirdCar = $garage->Add($auto3);

    echo "Primer auto agregado: " . $addFirstCar . "<br>";
    echo "Segundo auto agregado: " . $addSecondCar . "<br>";
    echo "Tercer auto agregado: " . $addThirdCar . "<br>";
    echo "Cuarto auto agregado: " . $addRepeatThirdCar . "<br>"; 

    echo "<br><br>ListaOriginal";
    $garage->MostrarGarage();
    $garage->Remove($auto3);
    $garage->Remove($auto3);
    echo "<br><br>ListaDeleteada";
    $garage->MostrarGarage();

    echo "<br><br>Garage pasado CSV";
    Garage::GarageACSV($garage);

    echo "<br><br>Garage leido CSV";
    Garage::CSVAGarage()->MostrarGarage();
    
?>