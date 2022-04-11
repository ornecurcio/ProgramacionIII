<?php
require_once("Producto.php");
if(isset($_POST['codigoBarra']) ||
    isset($_POST['nombre']) ||
    isset($_POST['tipo']) || 
    isset($_POST['stock']) ||
    isset($_POST['precio'])) {    
        //Para guardar en el json unicamente
        // $productos = array(
        //     new Producto("545464","Jabon","Higiene",50,75.5),
        //     new Producto("424449","Alcohol","Higiene",80,120.2),
        //     new Producto("345848","Toalla","Higiene",25,440.3),
        //     new Producto("244897","Shampoo","Higiene",12,770.5),
        //     new Producto("144814","Lavandina","Higiene",33,85,7),
        //     new Producto("100854","Teclado","Informatica",2,660.5),
        //     new Producto("124484","Mousse","Informatica",7,290,2)
        // );
        // $fileName = "productos.json";
        // if($productos !== null){
        //     $archivo = fopen($fileName,'a');   
        //     $jsonString =Producto::SerializarProductos($productos);      
        //     // echo(fwrite($archivo,$jsonString));
        // }
        // fclose($archivo);  
        $codBarra = $_POST['codigoBarra'];
        $nombre = $_POST['nombre'];
        $stock = $_POST['stock'];
        $precio = $_POST['precio'];
        $tipo = $_POST['tipo'];

        
        $p1 = new Producto($codBarra,
        $nombre,$tipo ,$stock,$precio);
        $fileName = "productos.json";
        
        $archivo = fopen($fileName,'r'); 
        $fSize = filesize($fileName);
        $fread;
        if ($fSize > 0) {
            $fread = fread($archivo,$fSize);
            
        } else {
            $fread = '{}';
        }
        $arrayJSON = [];
        // var_dump($fread);
        $arrayJSON = json_decode($fread);
              
        var_dump($arrayJSON);
        echo(Producto::Add($arrayJSON,$p1));        
        fclose($archivo);  
    }
?>