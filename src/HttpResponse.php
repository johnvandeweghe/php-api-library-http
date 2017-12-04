<?php
namespace PHPAPILibrary\Http;

use PHPAPILibrary\Core\CacheControlInterface;
use PHPAPILibrary\Core\Network\Response\Response;
use Psr\Http\Message\ResponseInterface;

class HttpResponse extends Response
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(CacheControlInterface $cacheControl, ResponseInterface $response)
    {
        parent::__construct($cacheControl, $response->getBody());
        $this->response = $response;
    }
}
