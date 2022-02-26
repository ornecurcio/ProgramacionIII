
<?php 

#variable numerica; 
$numero = 5; 
echo "Esto es una variable Numerica, valor cargado: $numero <br>"; 
var_dump($numero); 
echo "<br><br>"; 

#varible string
$palabra = "palabra"; 
echo "Esto es una variable string, valor cargado: $palabra <br>";
var_dump($palabra);  
echo "<br><br>";

#variable boleana
$boleana = true; 
echo "Esto es una variable boleana, valor cargado: $boleana <br>"; 
var_dump($boleana); 
echo "<br><br>";

#variable Array
$meses = array("enero", "febrero", "marzo","abril"); 
echo "Esto es un Array: $meses[0] <br>"; 
var_dump($meses); 
echo "<br><br>";

#variable Array con propiedades
$verduras = array("verdura1"=>"lechuga", "verdura2"=>"tomate", "verdura3"=>"cebolla", "verdura4"=>"puerro");
echo "Esto es un Array con propiedades: $verduras[verdura1] <br>"; 
var_dump($verduras); 
echo "<br><br>";

#variables Objeto
$frutas = (object)["fruta1"=>"manzana", "fruta2"=>"pera", "fruta3"=>"banana", "fruta4"=>"frutilla"];
echo "Esto es un objet: $frutas->fruta1 <br>"; 
var_dump($frutas); 
echo "<br><br>";

    //vbrowsers versions
    // echo $_SERVER['HTTP_USER_AGENT'];

    //if you want to check for Internet Explorer you can do this:
    // if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
    //     echo 'You are using Internet Explorer.<br />';
    // }
    // else
    // {
    //     echo 'You aren´t using Internet Explorer.<br />';
    // }

    // $mystring = 'abc';
    // $findme   = 'a';
    // $pos = strpos($mystring, $findme);

    // Note our use of ===.  Simply == would not work as expected
    // because the position of 'a' was the 0th (first) character.
    // if ($pos === false) {
    //     echo "The string '$findme' was not found in the string '$mystring'";
    // } else {
    //     echo "The string '$findme' was found in the string '$mystring'";
    //     echo " and exists at position $pos";
    // }
    // We can search for the character, ignoring anything before the offset
    /*$findme   = 'a';
    $newstring = 'abcdefa';
    $pos = strpos($newstring, $findme, 1); // $pos = 7, not 0
    if ($pos === false) {
        echo "The string '$findme' was not found in the string '$newstring'";
    } else {
        echo "The string '$findme' was found in the string '$newstring'";
        echo " and exists at position $pos";
    }*/


?>