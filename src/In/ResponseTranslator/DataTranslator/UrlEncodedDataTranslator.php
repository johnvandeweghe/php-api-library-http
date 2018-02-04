<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator;

use function GuzzleHttp\Psr7\stream_for;
use PHPAPILibrary\Core\Identity\ResponseInterface;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateResponseException;
use PHPAPILibrary\Core\Network\In\ResponseTranslator\DataTranslatorInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Converts data into url encoded data.
 * I.E. [coolvar => 123, othervar=321] will become coolvar=123&othervar=312
 * Class UrlEncodedDataTranslator
 * @package PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator
 */
class UrlEncodedDataTranslator implements DataTranslatorInterface
{

    /**
     * @param ResponseInterface $response
     * @return StreamInterface
     * @throws UnableToTranslateResponseException
     */
    public function translateData(ResponseInterface $response): StreamInterface
    {
        return stream_for(http_build_query($response->getData()));
    }
}
