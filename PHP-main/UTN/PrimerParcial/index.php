<?php

$metodo = $_SERVER['REQUEST_METHOD'];

switch($metodo)
{
    case "POST":
        switch(key($_GET))
        {
            case "consultar":
                include 'HamburguesaConsultar.php';
                break;             
            case "vender":
                include 'AltaVenta.php';
                break;
            case "cargar":
                include 'HamburguesaCarga.php';
                break;          
            case "devolver":
                include 'DevolverHamburguesa.php';
                break; 
        }
    case "GET":
        switch(key($_GET))
        {
            case "consultas":
                include 'ConsultasVentas.php';
               break;
            case "consultasDev":
                include 'ConsultaDevoluciones.php';
            break;
        }
    case "PUT":
        {
            include 'ModificarVenta.php';
            break;
        }
    case "DELETE":
        {
            include 'BorrarVenta.php';
            break;
        }
}


?>