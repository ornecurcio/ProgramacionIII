<?php

class AccesoDatos
{
    private static $ObjetoAccesoDatos;
    private $objetoPDO;
 
    private function __construct()
    {
        try 
        {      
            $host = "127.0.0.1";
            $dbname = "PizzeriaApp"; 
            $this->objetoPDO = new PDO("mysql:host=$host;dbname=$dbname", 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
        } 
        catch (PDOException $e) 
        { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }
 
    public function RetornarConsulta($sql)
    { 
        return $this->objetoPDO->prepare($sql); 
    }

    public function RetornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }
 
    public static function dameUnObjetoAcceso()
    { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new AccesoDatos(); 
        } 
        return self::$ObjetoAccesoDatos;        
    }

     // Evita que el objeto se pueda clonar
    public function __clone()
    { 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }

    public static function ExisteEnBd($id, $tabla)
    {
        $retorno = null;

        try
        {
            $conexion = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $conexion->RetornarConsulta("SELECT * FROM $tabla WHERE $id = $tabla.id");
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            if(sizeof($resultado) > 0)
            {
                $retorno = $resultado;
            }
        }
        catch(Throwable $mensaje)
        {
            printf("Error al buscar en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {
            return $retorno;
        }
    }

    public static function BorrarEnBd($id, $tabla)
    {
        $retorno = false;
        try
        {   
            if($id != null)
            {
                $conexion = AccesoDatos::dameUnObjetoAcceso();

                $insert = $conexion->RetornarConsulta("DELETE 
                                                        FROM $tabla
                                                        WHERE $id = $tabla.id");
                $fecha = new DateTime(date("d-m-Y H:i:s"));
                $insert->bindValue(':fecha_baja', date_format($fecha, 'Y-m-d H:i:s'));
                $insert->execute();
                $retorno = true;
            }
        }
        catch(Throwable $mensaje)
        {
            printf("Error al borrar en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {
            return $retorno;
        }
    }

    public static function imprimirConsulta($sql, $titulo = null)
    {
        if($titulo != null)
        {
            printf($titulo."<br>");
        }

        $datos = Toolkit::ImprimirConsulta($sql);
        Toolkit::ImprimirArrayComoTabla($datos);

    }

    public static function ObtenerConsulta($sql, $clase = null)
    {
        try
        {
            $conexion = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $conexion->RetornarConsulta($sql);
            $consulta->execute();
            $retorno = $consulta->fetchAll(PDO::FETCH_CLASS, $clase);
            
        }
        catch(Throwable $mensaje)
        {
            printf("Error de la BD: <br> $mensaje .<br>");
        }
        finally
        {
            return $retorno;
        }    
    }

    public static function retornarObjeto($id, $tabla, $clase)
    {
        $sql = "SELECT * FROM $tabla WHERE $id = $tabla.id";
        return AccesoDatos::ObtenerConsulta($sql, $clase);
    }

    public static function retornarObjetoPorCampo($valor, $campo, $tabla, $clase)
    {
        $sql = "SELECT * FROM $tabla WHERE $tabla.$campo = '$valor'";
        return AccesoDatos::ObtenerConsulta($sql, $clase);
    }

    public static function retornarObjetoActivo($id, $tabla, $clase)
    {
        $sql = "SELECT * FROM $tabla WHERE $id = $tabla.id AND $tabla.fecha_baja is null";
        return AccesoDatos::ObtenerConsulta($sql, $clase);
    }

    public static function obtenerTodos($tabla, $clase)
    {
        $sql = "SELECT * FROM $tabla;";
        return AccesoDatos::ObtenerConsulta($sql, $clase);
    }

    public static function modificarCampo($id, $tabla, $campo, $valor)
    {
        $retorno = false;
        try
        {   
            if($id != null && $campo != 'id')
            {
                $conexion = AccesoDatos::dameUnObjetoAcceso();
                $consulta = $conexion->RetornarConsulta("UPDATE $tabla 
                                                         SET $campo = '$valor'
                                                         WHERE id = $id");
                $consulta->execute();
                $retorno = true;
            }
        }
        catch(Throwable $mensaje)
        {
            printf("Error al modificar en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {

            return $retorno;
        }
    }

}
?>
