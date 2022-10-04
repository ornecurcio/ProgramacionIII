<?php

  include 'Producto.php';
    
  $metodo = $_SERVER ['REQUEST_METHOD'];
  $pCodigo = $_POST['codigo'];
  $pNombre = $_POST['nombre'];
  $pTipo = $_POST['tipo'];
  $pStock = $_POST['stock'];
  $pPrecio = $_POST['precio'];
  $id = rand(1,10000);
  $bandera = true;
  $array = array(); 

  //--- Sets the timezone to use. ---//
  date_default_timezone_set('America/Argentina/Buenos_Aires');

  switch ($metodo) 
  {
    case 'POST':
        if($bandera)
        {
            $nuevoProducto = new Producto($id, $pCodigo, $pNombre, $pTipo, $pStock, $pPrecio);  
            
        }  
        $array= Producto::LeerJSON();
        echo '<h1>Producto Creado</h1>';
        var_dump($nuevoProducto);
        $array = Product::UpdateArray($array, $nuevoProducto);
        Producto::EscribirEnJSON($myArray);
    break;
  }
?>
