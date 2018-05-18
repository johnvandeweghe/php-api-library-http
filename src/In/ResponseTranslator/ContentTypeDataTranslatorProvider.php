<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\In\ResponseTranslator\DataTranslatorInterface;
use PHPAPILibrary\Http\Data\Response;
use PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator\JsonDataTranslator;
use PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator\UrlEncodedDataTranslator;

/**
 * Class ContentTypeDataTranslatorProvider
 * @package PHPAPILibrary\Http\In
 */
class ContentTypeDataTranslatorProvider
{
    protected const MIME_TYPE_JSON =  "application/json";
    protected const MIME_TYPE_URLENCODED = "application/x-www-form-urlencoded";

    /**
     * @var JsonDataTranslator
     */
    protected $jsonTranslator;
    /**
     * @var UrlEncodedDataTranslator
     */
    protected $urlEncodedTranslator;

    /**
     * ContentTypeDataTranslatorProvider constructor.
     * @param JsonDataTranslator|null $jsonTranslator - If null will default to a default instantiation
     * @param UrlEncodedDataTranslator|null $urlEncodedTranslator - If null will default to a default instantiation
     */
    public function __construct(
        ?JsonDataTranslator $jsonTranslator = null,
        ?UrlEncodedDataTranslator $urlEncodedTranslator = null
    )
    {
        if($jsonTranslator === null) {
            $jsonTranslator = new JsonDataTranslator();
        }

        if($urlEncodedTranslator === null) {
            $urlEncodedTranslator = new UrlEncodedDataTranslator();
        }

        $this->jsonTranslator = $jsonTranslator;
        $this->urlEncodedTranslator = $urlEncodedTranslator;
    }

    /**
     * @param Response $response
     * @return DataTranslatorInterface
     * @throws UnableToTranslateRequestException
     */
    public function getDataTranslator(Response $response): DataTranslatorInterface
    {
        //Create a fake response so we can use the header line parser from psr7
        $psrResponse = new \GuzzleHttp\Psr7\Response(200, $response->getHttpData()->getHeaders());
        return $this->getTranslatorByContentTypeHeader($psrResponse->getHeaderLine("Content-type") ?: null);
    }

    /**
     * Case insensitive, get a translator, null if one can't be found.
     * @param null|string $contentType
     * @return null|DataTranslatorInterface
     */
    protected function getTranslatorByContentTypeHeader(?string $contentType): ?DataTranslatorInterface
    {
        if($contentType === null) {
            return null;
        }

        switch (strtolower($contentType)) {
            case self::MIME_TYPE_JSON:
                return $this->jsonTranslator;
            case self::MIME_TYPE_URLENCODED:
                return $this->urlEncodedTranslator;
            default:
                return null;
        }
    }
}
