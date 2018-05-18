<?php
namespace PHPAPILibrary\Http;

interface ResponseDataInterface extends \PHPAPILibrary\Core\Data\DataInterface
{
    /**
     * Get data parsed from an HTTP request.
     * @return array|object|null
     */
    public function getData();

    /**
     * HTTP Status code this response represents
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Get header lines.
     * @return string[][]
     */
    public function getHeaders(): array;

    /**
     * Get cookie values.
     * @return string[]
     */
    public function getCookies(): array;

}
