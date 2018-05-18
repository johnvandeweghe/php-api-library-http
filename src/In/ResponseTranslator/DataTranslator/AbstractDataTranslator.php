<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator;

use PHPAPILibrary\Core\Data\ResponseInterface;
use PHPAPILibrary\Core\Network\In\ResponseTranslator\DataTranslatorInterface;
use PHPAPILibrary\Http\HttpResponse;
use PHPAPILibrary\Http\In\ResponseTranslator\Exception\UnableToTranslateResponseException;
use Psr\Http\Message\StreamInterface;

/**
 * Class ContentTypeDataTranslator
 * @package PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator
 */
abstract class AbstractDataTranslator implements DataTranslatorInterface
{
    /**
     * @param ResponseInterface $response
     * @return StreamInterface
     * @throws UnableToTranslateResponseException
     */
    public function translateData(ResponseInterface $response): StreamInterface
    {
        if(!($response instanceof \PHPAPILibrary\Http\Data\Response)){
            throw new UnableToTranslateResponseException(
                new HttpResponse(new \GuzzleHttp\Psr7\Response(500)),
                "A DataTranslator can only translate Http\\Data\\Responses."
            );
        }

        return $this->translateRequestBody($response->getHttpData()->getData());
    }


    /**
     * @param mixed $responseData
     * @return StreamInterface
     * @throws UnableToTranslateResponseException
     */
    abstract protected function translateRequestBody($responseData): StreamInterface;
}
