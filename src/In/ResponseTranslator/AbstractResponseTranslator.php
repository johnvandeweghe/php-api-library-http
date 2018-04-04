<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator;

use GuzzleHttp\Psr7\Response;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateResponseException;
use PHPAPILibrary\Core\Network\ResponseInterface;
use PHPAPILibrary\Core\Network\In\ResponseTranslator\DataTranslatorInterface;
use PHPAPILibrary\Http\HttpResponse;
use PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator\ContentTypeDataTranslator;
use Psr\Http\Message\StreamInterface;

/**
 * Class AbstractResponseTranslator
 * @package PHPAPILibrary\Http\In
 */
abstract class AbstractResponseTranslator extends \PHPAPILibrary\Core\Network\In\ResponseTranslator\AbstractResponseTranslator
{
    /**
     * @return DataTranslatorInterface
     */
    protected function getDataTranslator(): DataTranslatorInterface
    {
        return $this->getContentTypeDataTranslator();
    }

    /**
     * @param StreamInterface $data
     * @param \PHPAPILibrary\Core\Data\ResponseInterface $response
     * @return ResponseInterface
     * @throws UnableToTranslateResponseException
     */
    protected function buildResponse(
        StreamInterface $data,
        \PHPAPILibrary\Core\Data\ResponseInterface $response
    ): ResponseInterface {
        //TODO: Figure out how to be told what status to return??
        return new HttpResponse(new Response(200, [], $data));
    }


    /**
     * @return ContentTypeDataTranslator
     */
    abstract protected function getContentTypeDataTranslator(): ContentTypeDataTranslator;


    //TODO: Derive header/response status?

}
