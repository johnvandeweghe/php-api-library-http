<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator;

use function GuzzleHttp\Psr7\stream_for;
use Psr\Http\Message\StreamInterface;

/**
 * Converts data into url encoded data.
 * I.E. [coolvar => 123, othervar=321] will become coolvar=123&othervar=312
 * Class UrlEncodedDataTranslator
 * @package PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator
 */
class UrlEncodedDataTranslator extends AbstractDataTranslator
{
    /**
     * @param mixed $responseData
     * @return StreamInterface
     * @throws \PHPAPILibrary\Http\In\ResponseTranslator\Exception\UnableToTranslateResponseException
     */
    protected function translateRequestBody($responseData): StreamInterface
    {
        return stream_for(http_build_query($responseData));
    }
}
