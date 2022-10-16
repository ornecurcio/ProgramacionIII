<?php

include_once "Toolkit.php";
include_once "GuardarLeerJson.php";
include_once "Producto.php";
include_once "Usuario.php";

class Venta
{
    public $_id;
    public $_usuario;
    public $_producto;
    public $_cantidad;
    public $_fecha; 
    public $_file;

    public function __construct($usuario, $producto, $cantidad, $file)
    {
       $this->_usuario = $usuario; 
       $this->_producto = $producto;
        $this->_cantidad = $cantidad;
        $this->_file = $file;
    }

    public function Alta($usuario, $producto, $arrayProductos, $arrayVentas, $rutaProductos, $rutaVentas)
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
            // $idUsuarioAux = Herramientas::SacarValorDeClave($usuario, "_id");
            // $this->_idUsuario = $idUsuarioAux;
            // $this->_idProducto = $idProductoAux;
            $this->_fecha = new DateTime("now");
            $archivo = $this->GuardarImagen($producto, $usuario);
            $this->_file = $archivo;
            Toolkit::AsignarId($this, $arrayVentas); 
            //var_dump($this);
            
            array_push($arrayVentas, $this); 
            GuardarLeerJson::GrabarEnJson($arrayVentas,$rutaVentas);
           
            $cantidad = Toolkit::SacarValorDeClave($this, "_cantidad"); 
            Producto::RestarStock($idProductoAux,$arrayProductos, $rutaProductos, $cantidad);
            $retorno = true;
            
        } 

        return $retorno;
    }

    /*b- (1 pt) Completar el alta con imagen de la venta , guardando la imagen con el tipo+nombre+mail (solo usuario
    hasta el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.*/
    public function GuardarImagen($producto, $usuario)
    {     
        $tipoProducto = Toolkit::SacarValorDeClave($producto, "_tipo");
        $nombreProducto = Toolkit::SacarValorDeClave($producto, "_sabor"); 
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
       
        $productoAux = new Producto($nombre, $tipo, null, null, null);
        $arrayProductos = GuardarLeerJson::LeerJson("Heladeria.json"); //OJO
        $arrayUsuarios = GuardarLeerJson::LeerJson("Usuarios.json");
        $indice = Toolkit::ConsultaSiHayYCual($productoAux, $arrayProductos);

        if($indice > -1)
        {
            $hayStock = Producto::HayStockSuficiente($arrayProductos[$indice], $cantidad);
            if($hayStock)
            {
                $arrayVentas = GuardarLeerJson::LeerJson("Ventas.json"); 
                $venta = Toolkit::ConseguirObjetoPorId($numeroPedido, $arrayVentas); 
                if($venta)
                {
                    $idProducto = Toolkit::SacarValorDeClave($arrayProductos[$indice], "_id");
                    $usuarioAux = new Usuario($email);
                    $usuarioAux = $usuarioAux->Alta($arrayUsuarios, "Usuarios.json");
                    $idUsuario = Toolkit::SacarValorDeClave($usuarioAux, "_id");
                    $venta->_usuario = $usuarioAux; 
                    $venta->producto = $productoAux; 
                    $venta->_cantidad = $cantidad; 
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