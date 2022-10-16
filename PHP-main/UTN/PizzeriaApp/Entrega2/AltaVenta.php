<?php
include_once 'Pizza.php';
include_once 'Venta.php';
include_once 'Usuario.php';
include_once 'GuardarLeerJson.php';
include_once 'Herramientas.php';
include_once 'AccesoDatos.php';


$sabor = $_POST["sabor"];
$tipo = $_POST["tipo"];
$cantidad = $_POST["cantidad"];
$email = $_POST["email"];
$archivo = $_FILES["archivo"]; 

$rutaProductos = "Pizza.json"; 
$rutaUsuarios = "Usuarios.json"; 
$rutaVentas = "Ventas.json"; 

$arrayProductos = GuardarLeerJson::LeerJson($rutaProductos);
$arrayUsuarios = GuardarLeerJson::LeerJson($rutaUsuarios);
$arrayVentas = GuardarLeerJson::LeerJson($rutaVentas);

$productoAux = new Producto($sabor, $tipo, null, null, null);
$usuarioAux = new Usuario($email);
$ventaAux = new Venta($productoAux,$usuarioAux,$cantidad, $archivo);

$indiceProductoAux = Herramientas::ConsultaSiHayYCual($productoAux, $arrayProductos);

if(isset($sabor) && isset($tipo) && isset($cantidad) && isset($email) && isset ($archivo))
{
    if($indiceProductoAux > -1)
    {     
        $productoAuxEnArray = $arrayProductos[$indiceProductoAux];
        $stockProductoAuxEnArray = Herramientas::SacarValorDeClave($productoAuxEnArray, "_cantidad");
        $cantidadPedido = Herramientas::SacarValorDeClave($ventaAux, "_cantidad");
    
        if($stockProductoAuxEnArray >= $cantidadPedido)
        {
            $usuarioAux = $usuarioAux->Alta($arrayUsuarios, $rutaUsuarios);
            if($ventaAux->Alta($usuarioAux, $productoAuxEnArray, $arrayProductos, $arrayVentas, 
                               $rutaProductos, $rutaVentas))
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