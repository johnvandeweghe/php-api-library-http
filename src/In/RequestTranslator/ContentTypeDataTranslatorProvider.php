<?php
namespace PHPAPILibrary\Http\In;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\In\RequestTranslator\DataTranslatorInterface;
use PHPAPILibrary\Http\HttpRequest;
use PHPAPILibrary\Http\In\RequestTranslator\DataTranslator\JsonDataTranslator;
use PHPAPILibrary\Http\In\RequestTranslator\DataTranslator\UrlEncodedDataTranslator;

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
     * @param HttpRequest $request
     * @return DataTranslatorInterface
     * @throws UnableToTranslateRequestException
     */
    public function getDataTranslator(HttpRequest $request): DataTranslatorInterface
    {
        return $this->getTranslatorByContentTypeHeader($request->getRequest()->getHeaderLine("Content-type") ?: null);
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
