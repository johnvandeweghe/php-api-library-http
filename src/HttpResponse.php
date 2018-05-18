<?php
namespace PHPAPILibrary\Http;

use PHPAPILibrary\Core\CacheControl\NoCacheControl;
use PHPAPILibrary\Core\CacheControlInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class HttpResponse implements \PHPAPILibrary\Core\Network\ResponseInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return CacheControlInterface
     */
    public function getCacheControl(): CacheControlInterface
    {
        // TODO: Implement getCacheControl() method. Check for cache headers and pass along values using CacheControl.
        return new NoCacheControl();
    }

    /**
     * @return StreamInterface|null
     */
    public function getData(): ?StreamInterface
    {
        return $this->response->getBody();
    }

    /**
     * Get header lines.
     * @return string[][]
     */
    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
