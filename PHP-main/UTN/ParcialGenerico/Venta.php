<?php

include_once "Toolkit.php";
include_once "GuardarLeerJson.php";
include_once "Hamburguesa.php";
include_once "Usuario.php";
include_once "AccesoDatos.php";

class Venta
{
    public $_id;
    public $_idUsuario;
    public $_idProducto;
    public $_cantidad;
    public $_fecha; 
    public $_file;

    public function __construct($cantidad, $file)
    {
        $this->_cantidad = $cantidad;
        $this->_file = $file;
    }

    public function Alta($usuario, $producto, $arrayProductos, $rutaProductos)
    {
        $idProductoAux = Toolkit::SacarValorDeClave($producto, "_id");
        $retorno = false;
        if($idProductoAux < 1)
        {
            printf("No existen productos de este tipo. No se puede hacer el pedido. <br>");
        }
        else
        {
            //var_dump($this);
            $idUsuarioAux = Toolkit::SacarValorDeClave($usuario, "_id");
            $this->_idUsuario = $idUsuarioAux;
            $this->_idProducto = $idProductoAux;
            $this->_fecha = new DateTime("now");
            $archivo = $this->GuardarImagen($producto, $usuario);
            $this->_file = $archivo;
            //var_dump($this);
            
            if($this->GrabarEnBD())
            {
                $cantidad = Toolkit::SacarValorDeClave($this, "_cantidad"); 
                Hamburguesa::RestarStock($this->_idProducto, $arrayProductos, $rutaProductos, $cantidad);
                $retorno = true;
            }
        } 

        return $retorno;
    }

    public function GrabarEnBD()
    {
        $retorno = false;
        
        try
        {
            $conexion = AccesoDatos::dameUnObjetoAcceso();
            //var_dump($conexion);

            $insert = $conexion->RetornarConsulta('INSERT INTO venta (id_usuario, id_producto, cantidad, fecha, archivo) VALUES  (:idUsuario,:idProducto,:cantidad,:fecha,:archivo)');
            $insert->bindValue(":idUsuario", $this->_idUsuario,);
            $insert->bindValue(":idProducto", $this->_idProducto);
            $insert->bindValue(":cantidad", $this->_cantidad);
            $insert->bindValue(":fecha", $this->_fecha->format("Y-m-d H:i:s"));
            $insert->bindValue(":archivo", $this->_file);
            $insert->execute();

            $retorno = true;
        }
        catch (Throwable $mensaje)
        {
            printf("Error al guardar en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {
            return $retorno;
        }
    }
    /*b- (1 pt) Completar el alta con imagen de la venta , guardando la imagen con el tipo+nombre+mail (solo usuario
    hasta el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.*/
    public function GuardarImagen($producto, $usuario)
    {     
        $tipoProducto = Toolkit::SacarValorDeClave($producto, "_tipo");
        $nombreProducto = Toolkit::SacarValorDeClave($producto, "_nombre"); //OJO
        $mailUsuario = Toolkit::SacarValorDeClave($usuario, "_mail");
        $nombreUsuario = strtok($mailUsuario, '@');
        $fecha = Toolkit::SacarValorDeClave($this, "_fecha");
        $fechaString = $fecha->format("YmdHis");
  
        $nombreFoto = $tipoProducto."_".$nombreProducto."_".$nombreUsuario."_".$fechaString.".jpg";
        $destino = ".".DIRECTORY_SEPARATOR."ImagenesDeLaVenta".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;

        if(!file_exists($destino))
        {
            mkdir($destino, 0777, true);
        }

        $dir = $destino.$nombreFoto;
        move_uploaded_file($this->_file["tmp_name"], $dir);
        return $dir;
    }

    public static function Modificacion($numeroPedido, $email, $nombre, $tipo, $cantidad)
    {      
       
        $productoAux = new Hamburguesa($nombre, $tipo, null, null, null);
        $arrayProductos = GuardarLeerJson::LeerJson("Hamburguesas.json");// OJO
        $arrayUsuarios = GuardarLeerJson::LeerJson("Usuarios.json");//OJO
        $indice = Toolkit::ConsultaSiHayYCual($productoAux, $arrayProductos);

        if($indice > -1)
        {
            $hayStock = Hamburguesa::HayStockSuficiente($arrayProductos[$indice], $cantidad);
            if($hayStock)
            {

                $idProducto = Toolkit::SacarValorDeClave($arrayProductos[$indice], "_id");
                $usuarioAux = new Usuario($email);
                $usuarioAux = $usuarioAux->Alta($arrayUsuarios, "usuarios.json");
                $idUsuario = Toolkit::SacarValorDeClave($usuarioAux, "_id");
                
                if(Venta::ModificarEnBd($numeroPedido, $idUsuario, $idProducto, $cantidad))
                {
                    printf("Modificación realizada con éxito. <br>");
                }
                else
                {
                    printf("No existe este pedido. <br>");
                }
            }
            else
            {
                printf("No quedan productos de este tipo. <br>");
            }
        }
        else
        {
            printf("No existe este tipo de producto. <br>");
        }

    }

    public static function ModificarEnBd($numeroPedido, $idUsuario, $idProducto, $cantidad)
    {
        $retorno = false;
        try
        {
            if(AccesoDatos::ExisteEnBd($numeroPedido, "venta") != null)
            {
                $conexion = AccesoDatos::dameUnObjetoAcceso();
                $consulta = $conexion->RetornarConsulta("UPDATE venta
                                                         SET id_usuario = $idUsuario,
                                                             id_producto = $idProducto,
                                                             cantidad = $cantidad
                                                         WHERE id = $numeroPedido");
                $consulta->execute();
                $retorno = true;
            }
            else
            {
                $retorno = false;
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
    public static function Borrar($id)
    {   
        $retorno = false;
        $venta = AccesoDatos::ExisteEnBd($id, "venta");
        if($venta != null && AccesoDatos::BorrarEnBd($id, "venta"))
        {    
            $ruta = array_column($venta, "archivo");
            $aux = explode("/", $ruta[0]);
            var_dump($aux);
            printf($aux); 
            $nombreImagen = $aux[2];
            $antiguoDir = ".".DIRECTORY_SEPARATOR."ImagenesDeLaVenta".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
            $nuevoDir = ".".DIRECTORY_SEPARATOR."BACKUPVENTAS".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
            Venta::MoverImagen($nombreImagen, $antiguoDir, $nuevoDir);
            $retorno = true;
        }

        return $retorno;
    }
    
    public static function MoverImagen($nombreImagen, $antiguoDir, $nuevoDir)
    {
        if(!file_exists($nuevoDir)) 
        {
            mkdir($nuevoDir, 0777, true);
        }
        rename($antiguoDir.$nombreImagen, $nuevoDir.$nombreImagen);
    } 



}




?>