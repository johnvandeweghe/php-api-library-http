<?php
namespace PHPAPILibrary\Http;

interface DataInterface extends \PHPAPILibrary\Core\Data\DataInterface
{
    /**
     * Get data parsed from an HTTP request.
     * @return array|object|null
     */
    public function getData();

    /**
     * Get associative array of url parameters.
     * @return string[]
     */
    public function getQueryParameters(): array;

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
