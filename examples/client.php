<?php
require_once "../vendor/autoload.php";


$request = new \PHPAPILibrary\Http\HttpRequest(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

$lc = new \PHPAPILibrary\Http\Out\LayerController(
    new GuzzleHttp\Client(),
    new \PHPAPILibrary\Core\Network\AccessController\AllowAllAccessController(),
    new \PHPAPILibrary\Core\Network\CacheController\NullCacheController(),
    new \PHPAPILibrary\Core\Network\RateController\NoRateController(),
    new \PHPAPILibrary\Core\Network\Logger\NullLogger()
);

$response = $lc->handleRequest(new \PHPAPILibrary\Http\HttpRequest(new \GuzzleHttp\Psr7\Request("get", "http://google.com/")));

var_dump($response->getData()->getContents());
