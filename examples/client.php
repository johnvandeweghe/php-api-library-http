<?php
require_once "../vendor/autoload.php";


$request = new \PHPAPILibrary\Http\HttpRequest(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

$lc = new \PHPAPILibrary\Http\Out\LayerController(
    new GuzzleHttp\Client()
);

try {
    $response = $lc->handleRequest(new \PHPAPILibrary\Http\HttpRequest(new \GuzzleHttp\Psr7\Request("get",
        "http://google.com/")));
} catch (\PHPAPILibrary\Core\Network\Exception\AccessDeniedException $e) {
    $response = $e->getResponse();
} catch (\PHPAPILibrary\Core\Network\Exception\RateLimitExceededException $e) {
    $response = $e->getResponse();
} catch (\PHPAPILibrary\Core\Network\Exception\RequestException $e) {
    $response = $e->getResponse();
} catch (\PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException $e) {
    $response = $e->getResponse();
}

var_dump($response->getData()->getContents());
