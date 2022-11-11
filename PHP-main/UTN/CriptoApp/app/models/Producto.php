<?php
require_once './herramientas/Foto.php';


class Producto
{
    public $id;
    public $nombre;
    public $foto;
    public $nacionalidad;
    public $fechaBaja;

    public static function Alta($item)
    {
        $nombreFoto = $item->nombre.".jpg";
        $destino = ".".DIRECTORY_SEPARATOR."FotosArma".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
        $ruta = Foto::GuardarImagen($item, $nombreFoto, $destino);
        $item->foto = $ruta;
        return $item->crearProducto();
    }
   
    public static function Modificacion($item)
    {
        $itemAux = AccesoDatos::retornarObjetoActivoPorCampo($item->id, 'id', 'producto','Producto');

        if($itemAux[0] != null)
        {
            Producto::modificarProducto($item);
        }
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM producto");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }
    
    public function crearProducto()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO producto (nombre, foto, precio, nacionalidad) 
                                                                   VALUES (:nombre, :foto, :precio, :nacionalidad)");
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);

        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
        $consulta->bindValue(':nacionalidad', $this->nacionalidad, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function modificarProducto($producto)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE producto 
                                                      SET nombre = :nombre, 
                                                          -- foto = :foto, 
                                                          nacionalidad = :nacionalidad
                                                      WHERE id = :id");
        $consulta->bindValue(':id', $producto->id, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $producto->nombre, PDO::PARAM_STR);
        //$consulta->bindValue(':foto', $producto->foto, PDO::PARAM_STR);
        $consulta->bindValue(':nacionalidad', $producto->nacionalidad, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function borrarProducto($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE producto SET fechaBaja = :fechaBaja WHERE id = :id");
        $fecha = new DateTime(date("d-m-Y H:i:s"));
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->execute();
    }
}



?>