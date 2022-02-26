<?php

//======================================================================
// Realizar un programa que guarde su nombre en $nombre y su apellido en $apellido. 
// Luego mostrar el contenido de las variables con el siguiente formato:
// Perez,Juan.                  Utilizar el operador de concatenacion
//======================================================================
    $nombre = "Ornela Ivana";
    $apellido = "Curcio";
    $apellidoNombre = $apellido.", ".$nombre; // los . son para concatenar
    echo($apellidoNombre);
?>