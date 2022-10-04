<?php
 
class Usuario
{
    public $_id;
    public $_nombre;
    public $_apellido;
    public $_clave;
    public $_email;
    public $_fechaRegistro;
    public $_nombreImagen;

    public function __construct($id, $nombre, $apellido, $clave, $email, $fechaRegistro, $nombreImagen)
    {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setClave($clave);
        $this->setEmail($email);
        $this->setFechaRegistro($fechaRegistro);
        $this->setNombreImagen($nombreImagen);
    }

    public function setNombre($nombre)
    {
        if (is_string($nombre) && !empty($nombre)) 
        {
            $this->_nombre = $nombre;
        }
    }

    public function setApellido($apellido)
    {
        if (is_string($apellido) && !empty($apellido)) 
        {
            $this->_apellido = $apellido;
        }
    }

    public function setClave($clave)
    {
        if (is_string($clave) && !empty($clave)) 
        {
            $this->_clave = $clave;
        }
    }

    public function setEmail($email)
    {
        if (is_string($email) && !empty($email)) 
        {
            $this->_email = $email;
        }
    }

    public function setId($id)
    {
        if (is_int($id) && !empty($id)) 
        {
            $this->_id = $id;
        }
    }

    public function setFechaRegistro($fechaRegistro)
    {
        if (is_string($fechaRegistro) && !empty($fechaRegistro))
         {
            $this->_fechaRegistro = $fechaRegistro;
        }
    }

    public function setNombreImagen($nombreImagen)
    {
        if (is_string($nombreImagen) && !empty($nombreImagen)) 
        {
            $this->_nombreImagen = $nombreImagen;
        }
    }

    public function getNombre()
    {
        return $this->_nombre;
    }

    public function getApellido()
    {
        return $this->_apellido;
    }

    public function getClave()
    {
        return $this->_clave;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getFechaRegistro()
    {
        return $this->_fechaRegistro;
    }

    public function getNombreImagen()
    {
        return $this->_nombreImagen;
    }

    public static function MostrarUsuario(String $usuario)
    {
        echo "El usuario es: ".$Usuario->usuario;
    }

    private function openJSON($filename="Usuarios.json")
    {
        $usuarios = array();
        $file = fopen($filename, "r");
        if ($file) 
        {
            $json = fread($file, filesize($filename));
            $users = json_decode($json, true);
        }
        fclose($file);
        return $usuarios;
    }

    public static function ReadJSON($filename="Usuarios.json"):array
    {
        $usuarios = array();
        try 
        {
            if (file_exists($filename)) 
            {                  
                $file = fopen($filename, "r");
                if ($file) 
                {
                    $json = fread($file, filesize($filename));
                    $usuariosFromJson = json_decode($json, true);
                    foreach ($usuariosFromJson as $usuario)
                    {
                        array_push($usuarios, new Usuario($usuario["_id"], 
                                                          $usuario["_nombre"], 
                                                          $usuario["_apellido"], 
                                                          $usuario["_clave"], 
                                                          $usuario["_email"], 
                                                          $usuario["_fechaRegistro"], 
                                                          $usuario["_nombreImagen"]));
                    }
                }
                fclose($file);
            } 
        }catch (\Throwable $th) 
        {
            echo "Error leyendo el archivo";
        } 
        finally 
        {
            return $usuarios;
        }
    }

    public static function ReadCSV($filename="Usuarios.csv")
    {
        $file = fopen($filename, "r");
        $usuarios = array();
        try 
        {
            while (!feof($file)) 
            {
                $line = fgets($file);
                if (!empty($line)) 
                {
                    $line = str_replace(PHP_EOL, "", $line);
                    $usuarioArray = explode(",", $line);
                    array_push($usuarios, new Usuario($usuarioArray[0], $usuarioArray[1], $usuarioArray[2]));
                }
            }
        } 
        catch (\Throwable $th) 
        {
            echo "Error leyendo el archivo";
        }
        finally
        {
            fclose($file);
            return Usuario::ListarUsuario($usuarios);
        }
    }

    public function GuardarCSV():bool
    {
        $retorno = false;
        try 
        {
            $archivo = fopen("usuarios.csv", "a+");
            if ($archivo) 
            {
                $filas = fwrite($archivo, $this->getNombre().",".$this->getClave().",".$this->getEmail().PHP_EOL);
                if ($filas > 0) {
                    $retorno = true;
                }
            }
        } catch (\Throwable $th) {
            echo "Error al guardar el archivo";
        }finally{
            fclose($archivo);
        }

        return $retorno;
    }

    public function SaveToJSON($usuariosArray, $filename="Usuarios.json"):bool
    {
        $retorno = false;
        try 
        {
            $file = fopen($filename, "w");
            if ($file) 
            {
                $json = json_encode($usuariosArray, JSON_PRETTY_PRINT);
                fwrite($file, $json);
                $retorno = true;
            }
        } 
        catch (\Throwable $th) 
        {
            echo "Error al guardar el archivo";
        } finally {
            fclose($file);
            return $retorno;
        }
    }

    public static function ImprimirInfoUsuarios($arrayUsuarios = array())
    {
        echo "<ul>";
        try 
        {
            if (!empty($arrayUsuarios)) 
            {
                foreach ($arrayUsuarios as $usuarios) 
                {
                    echo "<li>".$usuarios->UserData()."</li>";
                }
            }
        } catch (\Throwable $th) 
        {
            echo 'Exception: '.$th->getMessage();
        }finally
        {
            echo "</ul>";
        }
    }

    public static function ValidarUsuario($email, $clave):bool
    {
        $retorno = false;
        $usuarios = array();
        try 
        {
            $usuarios = Usuario::ReadCSV();
            if ($usuarios) 
            {
                foreach ($usuarios as $usuario) 
                {
                    if ($usuario->getEmail() == $email && $usuario->getClave() == $clave) 
                    {
                        $retorno = true;
                    }
                }
            }
        } 
        catch (\Throwable $th) 
        {
            echo "Error while reading the file";
        } 
        finally 
        {
            return $retorno;
        }
    }

    public function errorMessageOfJSON(){
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return "No ha ocurrido ningún error";
            case JSON_ERROR_DEPTH:
                return "Se ha excedido la profundidad máxima de la pila.";
            case JSON_ERROR_STATE_MISMATCH:
                return "Error por desbordamiento de buffer o los modos no coinciden";
            case JSON_ERROR_CTRL_CHAR:
                return "Error del carácter de control, posiblemente se ha codificado de forma incorrecta.";
            case JSON_ERROR_SYNTAX:
                return "Error de sintaxis.";
            case JSON_ERROR_UTF8:
                return "Caracteres UTF-8 mal formados, posiblemente codificados incorrectamente.";
            case JSON_ERROR_RECURSION:
                return "El objeto o array pasado a json_encode() incluye referencias recursivas y no se puede codificar.";
            case JSON_ERROR_INF_OR_NAN:
                return "El valor pasado a json_encode() incluye NAN (Not A Number) o INF (infinito)";
            case JSON_ERROR_UNSUPPORTED_TYPE:
                return "Se proporcionó un valor de un tipo no admitido para json_encode(), tal como un resource.";
            default:
                return "Error desconocido";
        }
    }


    private static function ListarUsuario($usuarios):bool
    {
        $retorno = false;
        echo "<ul>";
        foreach ($usuarios as $usuario)
         {
            echo "<li>".$usuario->getId()."</li>";
            echo "<li>".$usuario->getNombre()."</li>";
            echo "<li>".$usuario->getApellido()."</li>";
            echo "<li>".$usuario->getClave()."</li>";
            echo "<li>".$usuario->getEmail()."</li>";
            echo "<li>".$usuario->getFechaRegistro()."</li>";
            $retorno = true;
        }
        echo "</ul>";

        return $retorno;
    }

    public function UserData()
    {
        return $this->getApellido().",".$this->getNombre().",".$this->getNombreImagen();
    }
}
?> 