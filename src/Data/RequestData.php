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

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return \serialize($this->request);
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $this->request = \unserialize($serialized);
    }
}
