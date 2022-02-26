<?php 
include "FiguraGeometrica.php";
include "Rectangulo.php";
//======================================================================
// La clase ​FiguraGeometrica​ posee:
// todos sus atributos protegidos,
// un constructor por defecto,
// un método getter y setter para el atributo ​_color​,
// un método virtual (​ToString​)
// y dos métodos abstractos: ​Dibujar​ (público) y ​CalcularDatos​ (protegido).

// CalcularDatos será invocado en el constructor de la clase derivada que corresponda,
// su funcionalidad será la de inicializar los atributos _superficie y _perimetro.
// Dibujar retornará un string (con el color que corresponda)
// formando la figura geométrica del objeto que lo invoque
// (retornar una serie de asteriscos que modele el objeto).
// Ejemplo:
// * *******
// *** *******
// ***** *******
// Utilizar el método ToString para obtener toda la información completa del objeto,
// y luego dibujarlo por pantalla.
//======================================================================

    $l1 = 4.2;
    $l2 = 2.3;
    $r = new Rectangulo($l1,$l2);
    $t = new Triangulo($l1,$l2);
    // $array($r->Dibujar());
     $dibujo = $r->Dibujar();
     echo($dibujo);
    
    //


?>