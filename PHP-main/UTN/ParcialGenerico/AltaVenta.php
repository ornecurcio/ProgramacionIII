<?php
/*AltaVenta.php: (por POST)se recibe el email del usuario y el nombre, tipo y cantidad ,si el ítem existe en
Hamburguesas.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id
autoincremental ) y se debe descontar la cantidad vendida del stock .*/

include_once 'Hamburguesa.php';
include_once 'Venta.php';
include_once 'Usuario.php';
include_once 'GuardarLeerJson.php';
include_once 'Toolkit.php';
include_once 'AccesoDatos.php';


$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$cantidad = $_POST["cantidad"];
$email = $_POST["email"];
$archivo = $_FILES["archivo"]; 

$rutaHamburguesas = "Hamburguesas.json"; // OJO
$rutaUsuarios = "Usuarios.json"; 

$arrayHamburguesas = GuardarLeerJson::LeerJson($rutaHamburguesas);
$arrayUsuarios = GuardarLeerJson::LeerJson($rutaUsuarios);

$hamburguesaAux = new Hamburguesa($nombre, $tipo, null, null, null);
$usuarioAux = new Usuario($email);
$ventaAux = new Venta($cantidad, $archivo);

$indiceHamburguesaAux = Toolkit::ConsultaSiHayYCual($hamburguesaAux, $arrayHamburguesas);

if(isset($nombre) && isset($tipo) && isset($cantidad) && isset($email) && isset ($archivo))
{
    if($indiceHamburguesaAux > -1)
    {     
        $hamburguesaAuxEnArray = $arrayHamburguesas[$indiceHamburguesaAux];
        $stockHamburguesaAuxEnArray = Toolkit::SacarValorDeClave($hamburguesaAuxEnArray, "_cantidad");
        $cantidadPedido = Toolkit::SacarValorDeClave($ventaAux, "_cantidad");
    
        if($stockHamburguesaAuxEnArray >= $cantidadPedido)
        {
            $usuarioAux = $usuarioAux->Alta($arrayUsuarios, $rutaUsuarios);
            if($ventaAux->Alta($usuarioAux, $hamburguesaAuxEnArray, $arrayHamburguesas, $rutaHamburguesas))
            {
                printf("Venta realizada con éxito.<br>");
            }
        }
        else
        {
            printf("No quedan productos de este tipo.<br>");
        }
    }
    else
    {
        printf("No existe este producto.<br>");
    }
}
else
{
    printf("Introduzca todos los valores.");
}



?>