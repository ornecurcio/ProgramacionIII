<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr7Middlewares\Middleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require_once  './middlewares/CheckTokenMiddleware.php';
require_once './middlewares/CheckPerfilMiddleware.php';

require __DIR__ . '/../vendor/autoload.php';

require_once './db/AccesoDatos.php';
// require_once './middlewares/Logger.php';

require_once './controllers/UsuarioController.php';
require_once './controllers/AutenticadorController.php';
require_once './controllers/CriptomonedaController.php';
require_once './controllers/VentaController.php';

// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Instantiate App
$app = AppFactory::create();

// Set base path
$app->setBasePath('/app');

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes
$app->group('/usuarios', function (RouteCollectorProxy $group) {
    $group->get('[/]', \CriptomonedaController::class . ':TraerTodos') ;
    $group->post('/altaVenta', \VentaController::class . ':CargarUno');
    $group->get('/ventasMoneda', \VentaController::class . ':TraerVentasPorCripto')->add(new CheckPerfilMiddleware());
    $group->get('/ventasParam', \VentaController::class . ':TraerVentasConParametros')->add(new CheckPerfilMiddleware());
    $group->post('/cargarCripto', \CriptomonedaController::class . ':CargarUno')->add(new CheckPerfilMiddleware());
    $group->delete('/borrarCripto', \CriptomonedaController::class . ':BorrarUno')->add(new CheckPerfilMiddleware());
    $group->put("/modificar", \CriptomonedaController::class . ':ModificarUno')->add(new CheckPerfilMiddleware());
    $group->delete("/borrar", \UsuarioController::class . ':BorrarUno')->add(new CheckPerfilMiddleware());
  })->add(new CheckTokenMiddleware());

$app->get('/traerCriptos', \CriptomonedaController::class . ':TraerTodos');
$app->get('/traerCriptosPorNac', \CriptomonedaController::class . ':TraerPorNacionalidad');
$app->get('/imprimirVentas', \VentaController::class . ':ImprimirPDF') ;

//Genero el token
$app->post('/login', \AutentificadorController::class . ':CrearTokenLogin');

$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("Parcial Programacion III - CRIPTOMONEDAS");
    return $response;
});

$app->run();
