<?php
namespace PHPAPILibrary\Http;

use PHPAPILibrary\Core\Network\RequestInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class HttpRequest
 * @package PHPAPILibrary\Http
 */
class HttpRequest implements RequestInterface
{
    /**
     * @var PsrRequestInterface
     */
    private $request;

    /**
     * HTTPRequest constructor.
     * @param PsrRequestInterface $request
     */
    public function __construct(PsrRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @return String
     */
    public function getVerb(): String
    {
        return $this->request->getMethod();
    }

    /**
     * @return String
     */
    public function getPath(): String
    {
        return $this->request->getRequestTarget();
    }

    /**
     * While this is the Stream from the HTTP PSR, HTTP is not required.
     * @return StreamInterface The data for the request.
     */
    public function getData(): StreamInterface
    {
        return $this->request->getBody();
    }

    /**
     * @return PsrRequestInterface
     */
    public function getRequest(): PsrRequestInterface
    {
        return $this->request;
    }
}
