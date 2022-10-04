<?php

include_once "GuardiaLeerJson.php";

class Cupon
{
    public $id;
    public $id_devolucion;
    public $usado;
    public $descuento;
    public $importeFinal;

    public function Alta()
    {
        $this->GrabarEnBd();
    }
    
    public static function UsarEnBd($cupon, $importeFinal, $descuento)
    {
        $retorno = false;
        try
        {
            $conexion = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $conexion->RetornarConsulta("UPDATE cupon
                                                     SET importe_final = $importeFinal,
                                                         descuento = $descuento,
                                                         usado = '1'
                                                     WHERE id = $cupon->id");
            $consulta->execute();
            $retorno = true;
        }
        catch(Throwable $mensaje)
        {
            printf("Error al modificar en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {
            $array = AccesoDatos::obtenerTodos('cupon', 'Cupon');
            GuardarLeerJson::GrabarEnJson($array, 'Cupones.json');
            return $retorno;
        }     
    }

    public function GrabarEnBd()
    {
        $retorno = false;
        
        try
        {
            $conexion = AccesoDatos::dameUnObjetoAcceso();
            $insert = $conexion->RetornarConsulta('INSERT INTO cupon 
                                                               (id_devolucion, 
                                                                usado) 
                                                          VALUES (:id_devolucion, 
                                                                  :usado)');
            $insert->bindValue(":id_devolucion", $this->id_devolucion);
            $insert->bindValue(":usado", "0");
            $insert->execute();
            $retorno = true;
        }
        catch (Throwable $mensaje)
        {
            printf("Error al guardar el cupón en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {
            $array = AccesoDatos::obtenerTodos('cupon', 'Cupon');
            GuardarLeerJson::GrabarEnJson($array, 'cupon.json');
            return $retorno;
        }

    }

    public static function Imprimir($item) //borrar este comment si lo uso
    {
        $id = Toolkit::SacarValorDeClave($item, "id");
        $usado = Toolkit::SacarValorDeClave($item, "usado");
        $descuento = Toolkit::SacarValorDeClave($item, "descuento");
        $importeFinal = Toolkit::SacarValorDeClave($item, "importeFinal");

        printf("CUPON: <br>");
        printf("Id del cupón: $id <br>");
        if($usado)
        {
            printf("Usado. <br>");
            printf("Descuento aplicado: $descuento. <br>");
            printf("Importe final: $importeFinal. <br>");
        }
        else
        {
            printf("No usado. <br>");
        }
    }

    public static function ImprimirListado($array)
    {
        foreach($array as $item)
        {
            Cupon::Imprimir($item);
        }
    }
}




?>