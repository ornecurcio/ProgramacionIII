<?php
//Ornela Ivana Curcio

$metodo = $_SERVER['REQUEST_METHOD'];

switch($metodo)
{
    case "GET":
        switch(key($_GET))
        {
            case "cargar":
                include 'PizzaCargar.php';
                break;   
            case "consultas":
                include 'ConsultasVentas.php';
                break;       
        }
    case "POST":
        switch(key($_GET))
        {
            case "consultar":
                include 'PizzaConsultar.php';
                break;   
            case "vender":
                include 'AltaVenta.php';
                break;              
        }
}

?>