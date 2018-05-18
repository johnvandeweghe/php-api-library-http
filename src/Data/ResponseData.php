<?php
namespace PHPAPILibrary\Http\Data;

use PHPAPILibrary\Http\ResponseDataInterface;

/**
 * Class ResponseData
 * @package PHPAPILibrary\Http\Data
 */
class ResponseData implements ResponseDataInterface
{
    /**
     * @var int
     */
    private $statusCode;
    /**
     * @var
     */
    private $data;
    /**
     * @var array
     */
    private $headers;
    /**
     * @var array
     */
    private $cookies;

    /**
     * ResponseData constructor.
     * @param int $statusCode
     * @param $data
     * @param array $headers
     * @param array $cookies
     */
    public function __construct(int $statusCode = 200, $data = null, array $headers = [], array $cookies = [])
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
        $this->headers = $headers;
        $this->cookies = $cookies;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get data parsed from an HTTP request.
     * @return array|object|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get header lines.
     * @return string[][]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Get cookie values.
     * @return string[]
     */
    public function getCookies(): array
    {
        return $this->cookies;
    }
}
