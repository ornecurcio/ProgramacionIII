<?php
require_once("Usuario.php");
if(isset($_GET['listado'])) {    
    $opcionListado = strtolower($_GET['listado']);
    switch ($opcionListado) {
        case 'usuarios':
            $fileName = 'usuarios.json';
            //Para guardar en el json unicamente
            // $usuarios = array(
            //     new Usuario("Pedro","pedro@gmail.com","123",1,new DateTime("now")),
            //     new Usuario("Juan","juan@gmail.com","456",2,new DateTime("now")),
            //     new Usuario("Soledad","sol@gmail.com","789",3,new DateTime("now")),
            // );
            // if($usuarios !== null){
            //     $archivo = fopen($fileName,'w');
            //     fwrite($archivo,json_encode($usuarios));
            // }
            // fclose($archivo);           
            $archivo = fopen($fileName,'r');
            $fSize = filesize($fileName);    
            $strJsonFileContents = file_get_contents($fileName);
            $usuarios = [];
            $usuarios = json_decode($strJsonFileContents, true);
            foreach ($usuarios as $usuario) {
                    echo("<li>".$usuario['_nombre']."</li>");
                    echo("<li>".$usuario['_mail']."</li>");
                    echo("<li>".$usuario['_clave']."</li>");
                    echo("<li>".$usuario['_id']."</li>");
                    echo("<li>".$usuario['_fechaAlta']['date'])."</li>";
            }       
            fclose($archivo);
            break;
        }
    }
?>