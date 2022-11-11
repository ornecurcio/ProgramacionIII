<?php
require_once './herramientas/reportes.php';
require_once './db/AccesoDatos.php';

class ReporteController extends Reportes
{
    public function ListadoPorNacionalidadAPI($request, $response, $args)
    {
        try
        {
            $lista = Reportes::ListadoPorNacionalidad($args['nacionalidad']);
            $payload = json_encode(array("listaPorUnidad" => $lista));
            $response->getBody()->write($payload);
            $newResponse = $response->withHeader('Content-Type', 'application/json');
        }
        catch(Throwable $mensaje)
        {
            printf("Error al listar: <br> $mensaje .<br>");
        }
        finally
        {
            return $newResponse;
        }    
    }

    public function ListadoPorNombreAPI($request, $response, $args)
    {
        try
        {
            $lista = Reportes::ListadoPorNombre($args['nombre']);
            $payload = json_encode(array("listaPorNombre" => $lista));
            $response->getBody()->write($payload);
            $newResponse = $response->withHeader('Content-Type', 'application/json');
        }
        catch(Throwable $mensaje)
        {
            printf("Error al listar: <br> $mensaje .<br>");
        }
        finally
        {
            return $newResponse;
        }    
    }

    public function ProductoPorIdAPI($request, $response, $args)
    {
        try
        {
            $lista = AccesoDatos::retornarObjetoActivoPorCampo($args['id'], 'id','producto', 'Producto');
            $payload = json_encode(array("Producto: " => $lista));
            $response->getBody()->write($payload);
            $newResponse = $response->withHeader('Content-Type', 'application/json');
        }
        catch(Throwable $mensaje)
        {
            printf("Error al listar: <br> $mensaje .<br>");
        }
        finally
        {
            return $newResponse;
        }    
    }

    public function NacionalidadUSAAPI($request, $response, $args)
    {
        try
        {
            $lista = Reportes::NacionalidadUSA();
            $payload = json_encode(array("Producto" => $lista));
            $response->getBody()->write($payload);
            $newResponse = $response->withHeader('Content-Type', 'application/json');
        }
        catch(Throwable $mensaje)
        {
            printf("Error al listar: <br> $mensaje .<br>");
        }
        finally
        {
            return $newResponse;
        }    
    }

    public function UsuariosPorProductoAPI($request, $response, $args)
    {
        try
        {
            $lista = Reportes::UsuariosPorProducto($args['producto']);
            $payload = json_encode(array("UsuariosPorProducto" => $lista));
            $response->getBody()->write($payload);
            $newResponse = $response->withHeader('Content-Type', 'application/json');
        }
        catch(Throwable $mensaje)
        {
            printf("Error al listar: <br> $mensaje .<br>");
        }
        finally
        {
            return $newResponse;
        }    
    }
}

?>