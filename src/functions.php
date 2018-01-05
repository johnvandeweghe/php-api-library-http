<?php
namespace PHPAPILibrary\Http;

use Psr\Http\Message\ResponseInterface;

if(!function_exists('\PHPAPILibrary\Http\dumpResponse')) {
    /**
     * Dumps a PSR-7 ResponseInterface to the SAPI.
     * @param ResponseInterface $response
     */
    function dumpResponse(ResponseInterface $response): void
    {
        $statusLine = sprintf(
            "HTTP/%s %d %s",
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        );

        header($statusLine, true, $response->getStatusCode());

        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        $body = $response->getBody();
        while(!$body->eof()) {
            echo $body->read(1024);
        }
    }
}
