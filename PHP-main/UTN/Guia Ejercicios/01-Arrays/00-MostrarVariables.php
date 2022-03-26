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

    // function prompt($prompt_msg){
    //     echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");

    //     $answer = "<script type='text/javascript'> document.write(answer); </script>";
    //     return($answer);
    // }

    // //program
    // $prompt_msg = "Please type your name.";
    // $name = prompt($prompt_msg);
    // //$prompt_msg = "Please type your  lastname.";
    // //$lastname = prompt($prompt_msg);

    // $output_msg = "Hello there ".$name."!";
    // echo($output_msg);
?>