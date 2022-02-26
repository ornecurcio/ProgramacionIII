<?php
require_once("Pasajero.php");
require_once ("Vuelo.php");
//======================================================================

//======================================================================
    $listaPasajerosVueloA = array(
        new Pasajero("Gomez","Luis","39184456",false),
        new Pasajero("Fernandez","Maria","14156782",false));


    $vueloA = new Vuelo("Aerolineas Fleming",
    date_create("now"),
    100,5,$listaPasajerosVueloA);

    $vueloB = new Vuelo("Aerolineas Geraghty",
    date_create("now"),
    200);
    
    $vueloA->MostrarVuelo();
    $vueloB->MostrarVuelo();

    $vueloA->AgregarPasajero(new Pasajero("Lopez","Jose","11111111",false));
    $vueloA->MostrarVuelo();

    $vueloB->AgregarPasajero(new Pasajero("Quiroz","Ana","22114121",false));
    $vueloB->AgregarPasajero(new Pasajero("Gamarra","Hector","42219149",true));
    $vueloB->MostrarVuelo();

    echo("Suma total de v1 y v2: " . Vuelo::Add($vueloA,$vueloB));

    if(Vuelo::Remove($vueloA,$vueloA->_listaDePasajeros[1])){
        echo("<br/> Removido con exito");
    }
    else{
        echo("<br/> No se pudo remover pasajero ");
    }
    $vueloA->MostrarVuelo();

?>