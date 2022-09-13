<?php

class Usuario{
    
    public $_id;
    public $_nombre;
    public $_clave;
    public $_email;
    public $_fechaRegistro;

    public function __construct($id, $nombre, $clave, $email, $fechaRegistro){
        $this->setId($id);
        $this->setName($nombre);
        $this->setPassword($clave);
        $this->setEmail($email);
        $this->setRegisterDate($fechaRegistro);
    }

    public function setId($id){
        if (is_int($id) && !empty($id)) {
            $this->_id = $id;
        }
    }

    public function setName($nombre){
        if (is_string($nombre) && !empty($nombre)) {
            $this->_nombre = $nombre;
        }
    }

    public function setPassword($clave){
        if (is_string($clave) && !empty($clave)) {
            $this->_clave = $clave;
        }
    }

    public function setEmail($email){
        if (is_string($email) && !empty($email)) {
            $this->_email = $email;
        }
    }

    function setRegisterDate($fechaRegistro){
        if (is_string($fechaRegistro) && !empty($fechaRegistro)) {
            $this->_fechaRegistro = $fechaRegistro;
        }
    }

    public function getId(){
        return $this->_id;
    }

    public function getNombre(){
        return $this->_nombre;
    }

    public function getClave(){
        return $this->_clave;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function getFechaRegistro(){
        return $this->_fechaRegistro;
    }

    public static function MostrarUsuario(String $usuario){
        echo "El usuario es: ".$Usuario->usuario;
    }

    public static function GrabarEnCsv($usuario, $ruta)
    {             
        $retorno = false;
        //var_dump($usuario);
        if($usuario)
        {
            $separadoPorComa = implode(",", (array)$usuario);
            $file = fopen($ruta, "a+");
            if($file)
            {
                fwrite($file, $separadoPorComa.PHP_EOL); 
            }                 
            fclose($file);   
            $retorno = true;
        }
        return $retorno;                  
    }

    // public function GuardarCSV():bool{
    //     $success = false;
    //     try {
    //         $archivo = fopen("usuarios.csv", "a+");
    //         if ($archivo) {
    //             fwrite($archivo, $this->getName().",".$this->getPassword().",".$this->getEmail().PHP_EOL);
    //             $success = true;
    //         }
    //     } catch (\Throwable $th) {
    //         echo "Error al guardar el archivo";
    //     }finally{
    //         fclose($archivo);
    //     }

    //     return $success;
    // }
    public static function LeerCsv($archivo):array
    {
        $auxArchivo = fopen($archivo, "r");
        //var_dump($auxArchivo);
        $array = array();

        if(isset($auxArchivo))
        {
            try
            {
                while(!feof($auxArchivo))
                {
                    $registro = fgets($auxArchivo);
                    
                    if(!empty($registro))
                    {
                        //printf("entra a este if");
                        $campo = explode(",", $registro); 
                        //var_dump($campo);                     
                        array_push($array, new Usuario($campo[0], $campo[1], $campo[2])); 
                                            
                    }
                }
                //var_dump($array); 
            }
            catch(\Throwable $e)
            {
                echo "No se pudo leer el archivo<br>";
                printf($e);
            }
            finally
            {
                fclose($auxArchivo);
                return $array;
            }
        }
    }

    public static function ImprimirCsv($archivo)
    {
        $arrayDeUsuarios = Usuario::LeerCsv($archivo);
        //var_dump($arrayDeUsuarios);
        
        if(sizeof($arrayDeUsuarios) > 0)
        {
           Usuario::ImprimirUsuarios($arrayDeUsuarios);
        }

    }

    private static function ImprimirUsuarios($usuarios):bool
    {
        $retorno = false;
        echo "<ul>";
        foreach ($usuarios as $usuario) {
            echo "<li>".$usuario->getId()."</li>";
            echo "<li>".$usuario->getNombre()."</li>";
            echo "<li>".$usuario->getClave()."</li>";
            echo "<li>".$usuario->getEmail()."</li>";
            echo "<li>".$usuario->getFechaRegistro()."</li>";
            $retorno = true;
        }
        echo "</ul>";

        return $success;
    }

    // public static function ReadCSV($filename="usuarios.csv"){
    //     $file = fopen($filename, "r");
    //     $usuarios = array();
    //     try {
    //         while (!feof($file)) {
    //             $line = fgets($file);
    //             if (!empty($line)) {
    //                 $line = str_replace(PHP_EOL, "", $line);
    //                 $userArray = explode(",", $line);
    //                 array_push($usuarios, new Usuario($userArray[0], $userArray[1], $userArray[2]));
    //             }
    //         }
    //     } catch (\Throwable $th) {
    //         echo "Error al leer el archivo";
    //     }finally{
    //         fclose($file);
    //         return Usuario::ListUsers($usuarios);
    //     }
    // }

    public function GuardarJSON($usuarios, $ruta):bool
    {
        $retorno = false;
        try 
        {
            $file = fopen($ruta, "w");
            if ($file) 
            {
                var_dump($usuarios);
                $json = json_encode($usuarios, JSON_PRETTY_PRINT);
                echo $json . '<br>';
                fwrite($file, $json);
                $retorno = true;
            }
        } catch (\Throwable $th) 
        {
            echo "Error al guardar archivo";
        } finally 
        {
            fclose($file);
            return $retorno;
        }
    }

    public static function LeerJSON($ruta):array
    {
        $usuarios = array();
        
        try 
        {
            $file = fopen($ruta, "r");
            if ($file) 
            {
                $json = fread($file, filesize($ruta));
                $usuarios = json_decode($json, true);

            }
        } catch (\Throwable $th)
        {
            echo "Error al leer el archivo";
        } finally 
        {
            fclose($file);
            return $usuarios;
        }
    }

    public static function ValidarUsuario($email, $clave):bool
    {
        $retorno = false;
        $usuarios = array();
        try 
        {
            $usuarios = Usuario::LeerCSV();
            if ($usuarios) 
            {
                foreach ($usuarios as $usuario) 
                {
                    if ($usuario->getEmail() == $email && $user->getClave() == $clave) 
                    {
                        $retorno = true;
                    }
                }
            }
        } catch (\Throwable $th) 
        {
            echo "Error al leer el archivo";
        } finally 
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
}
?>