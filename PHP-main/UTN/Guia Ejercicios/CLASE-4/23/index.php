<?php

    include "usuario.php";
    //include "upload.php";

    $metodo = $_SERVER ['REQUEST_METHOD'];
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $email = $_POST['email'];
    $ruta = "usuarios.json"; 

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $ID = 0;
    $primerRegistro = false;

    //$upload = new upload($_FILES);
    var_dump($metodo);

    switch ($metodo) 
    {
        case 'POST':
            if (!$primerRegistro) 
            {
                $primerRegistro = true;
                $ID = rand(1, 10001);
            } 
            else 
            {
                $ID +=1;
            }
            $fechaRegistro = new DateTime('now');
            $usuario = new Usuario($ID, $nombre, $clave, $email, $fechaRegistro->format('d-m-Y H:m:s'));
            $usuarios = Usuario::LeerJSON($ruta);

            array_push($usuarios, $usuario);
            
            if ($usuario->GuardarJSON($usuarios,$ruta)) 
            {
                //echo $user->errorMessageOfJSON().'<br>';
                echo "Usuario guardado correctamente<br>";
            } 
            else 
            {
                echo "Error al guardar el usuario";
            }

            $destino = "uploads/".$_FILES["archivo"]["name"];
            move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino); 
            // if ($upload->saveFileIntoDir($_FILES)) 
            // {
            //     echo "Archivo guardado correctamente<br>";
            // }
            break;
    }
?>