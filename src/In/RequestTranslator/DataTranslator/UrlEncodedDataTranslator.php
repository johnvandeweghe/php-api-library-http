<?php
namespace PHPAPILibrary\Http\In\RequestTranslator\DataTranslator;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use Psr\Http\Message\StreamInterface;

/**
 * Treat the request body as form-urlencoded.
 * NOTE: Because of the underlying use of http://php.net/manual/en/function.parse-str.php this function converts dots
 * in keys to underscores. I.E. cool.var=123 will become [cool_var => 123]
 */
class UrlEncodedDataTranslator extends AbstractDataTranslator
{
    /**
     * Treat the stream as form-urlencoded.
     * NOTE: Because of the underlying use of http://php.net/manual/en/function.parse-str.php this function converts dots
     * in keys to underscores. I.E. cool.var=123 will become [cool_var => 123]
     * @param StreamInterface $stream
     * @return mixed
     * @throws UnableToTranslateRequestException
     */
    protected function translateRequestBody(StreamInterface $stream)
    {
        $result = [];

        parse_str($stream->getContents(), $result);

        return $result;
    }
}
