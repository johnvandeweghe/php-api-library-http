<?php
namespace PHPAPILibrary\Http\Data;

use PHPAPILibrary\Http\RequestDataInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class RequestData
 * @package PHPAPILibrary\Http\Data
 */
class RequestData implements RequestDataInterface
{
    /**
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * Data constructor.
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Get data parsed from an HTTP request.
     * @return array|object|null
     */
    public function getData()
    {
        return $this->request->getParsedBody();
    }

    /**
     * Get associative array of url parameters.
     * @return string[]
     */
    public function getQueryParameters(): array
    {
        return $this->request->getQueryParams();
    }

    /**
     * Get header lines.
     * @return string[][]
     */
    public function getHeaders(): array
    {
        return $this->request->getHeaders();
    }

    /**
     * Get cookie values.
     * @return string[]
     */
    public function getCookies(): array
    {
        return $this->request->getCookieParams();
    }

}
