<?php
require_once("Usuario.php");
if(isset($_GET['listado'])) 
{
    
    $opcionListado = strtolower($_GET['listado']);
    switch ($opcionListado) 
    {
        case 'usuarios':
            //Testing ok
            // $usuarios = array(
            //     new Usuario("Pedro","pedro@gmail.com","123"),
            //     new Usuario("Juan","juan@gmail.com","456"),
            //     new Usuario("Soledad","sol@gmail.com","789"),
            // );
            $usuarios = [];
            $file = fopen("usuarios.csv","r");
            $line;
            $retStr = "";
            while(!feof($file)) 
            {
                $line = fgets($file);
                // echo $line . "<br>";
                if(!$line)
                {
                    echo("No se pudo leer correctamente el archivo");
                    break;
                }
                else
                {
                    $auxStr = [];
                    //Instancio objetos Usuarios x cada linea
                    //formato>>> /nombre/mail/clave/
                    foreach (explode("/",$line) as $item) 
                    {
                        str_replace('/','',$item);
                        array_push($auxStr,$item);
                    }
                    $u = new Usuario($auxStr[0],$auxStr[1],$auxStr[2]);
                    if($u != null)
                    array_push($usuarios,$u);
                    echo(                    
                    "<ul>
                    <li>".$auxStr[0]."</li>
                    <li>".$auxStr[1]."</li>
                    <li>".$auxStr[2]."</li>
                    </ul>"
                    );
                }
            }    
            fclose($file);
            $strUsuarios = "";
            foreach ($usuarios as $item) 
            {
                $strUsuarios .= "<br/>".$item->MostrarDatos();
            }
            // if($strUsuarios != "")
            //     echo($strUsuarios);
            // else
            //     echo("No hay usuarios para mostrar");
            break;
        default:
            # code...
            break;
    }
}

?>