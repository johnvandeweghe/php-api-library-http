<?php
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Core\Network\ResponseInterface;

require_once "../vendor/autoload.php";
require_once "ExampleLambdaController.php";

$request = new \PHPAPILibrary\Http\HttpRequest(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

$router = new \PHPAPILibrary\Core\Network\Router\RegisteredPathRouter();

$router->addRoute("/", new ExampleLambdaController(function(RequestInterface $request): ResponseInterface
{
    return new \PHPAPILibrary\Http\HttpResponse(new \GuzzleHttp\Psr7\Response(200, [], "<html></html>"));
}));

$lc = new \PHPAPILibrary\Http\RoutingLayerController($router);

/**
 * @var \PHPAPILibrary\Http\HttpResponse $response
 */
$response = $lc->handleRequest($request);

\PHPAPILibrary\Http\dumpResponse($response->getResponse());
