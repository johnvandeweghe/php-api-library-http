<?php

require_once "../vendor/autoload.php";
require_once "ExampleLambdaDataController.php";

$request = new \PHPAPILibrary\Http\HttpRequest(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

$router = new \PHPAPILibrary\Core\Network\RegisteredPathRouter();

$router->addRoute("/", new \PHPAPILibrary\Http\In\LayerController(
    new ExampleLambdaDataController(
        function(\PHPAPILibrary\Http\Data\Request $request): \PHPAPILibrary\Http\Data\Response {
            return new \PHPAPILibrary\Http\Data\Response(
                new \PHPAPILibrary\Http\Data\ResponseData(
                    200,
                    [
                        "pong" => $request->getHttpData()->getData()["ping"] ?? null
                    ],
                    ["Content-Type" => ["application/json"]]
                )
            );
        }
    )
));

$lc = new \PHPAPILibrary\Http\RoutingLayerController($router);

/**
 * @var \PHPAPILibrary\Http\HttpResponse $response
 */
$response = $lc->handleRequest($request);

\PHPAPILibrary\Http\dumpResponse($response->getResponse());
