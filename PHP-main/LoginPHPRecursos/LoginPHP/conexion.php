<?php
include("configuracion.php"); 
$conexion = new mysqli($server,$user,$pass,$bd); 
if(mysqli_connect_errno()){
    echo "No conectado", mysql_connect_error();
    exit();  
}
else{
    echo "Conectado"; 
}
// $server = "localhost";
// $user = "root@localhost";
// $pass = "";
// $bd = "phplogin"; 
// $conn = mysqli_connect($server,$user,$pass,$bd);

// Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";
?>