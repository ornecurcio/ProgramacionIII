<?php
require_once("Usuario.php");
if(isset($_POST['nombre']) &&
 isset($_POST['mail']) &&
 isset($_POST['clave'])) {    
    $nombre = $_POST['nombre'];
    $mail = $_POST['mail'];
    $clave = $_POST['clave'];
    $usuario = new Usuario($nombre,$mail,$clave);
    $usuarios = [];
    $file = fopen("usuarios.csv","r");
    $line;
    $retStr = "";
    while(!feof($file)) {
        $line = fgets($file);
        // echo $line . "<br>";
        if(!$line){
            echo("No se pudo leer correctamente el archivo");
            break;
        }
        else{
            $auxStr = [];
            //Instancio objetos Usuarios x cada linea
            //formato>>> /nombre/mail/clave/
            foreach (explode("/",$line) as $item) {
                str_replace('/','',$item);
                array_push($auxStr,$item);
            }
            $u = new Usuario($auxStr[0],$auxStr[1],$auxStr[2]);
            if($u != null){
                $verificacion = Usuario::Verificar($u,$usuario);
                switch ($verificacion) {
                    case ELogin::Verificado:
                        echo("Verificado,los datos ingresados son correctos");
                        return;
                    case ELogin::ErrorDatos:
                        echo("Error en los datos, revise la clave");
                        return;
                    case ELogin::Inexistente:                        
                        break;
                }                 
               
            }
            
        }
    }
    echo("Usuario no registrado");
}
?>