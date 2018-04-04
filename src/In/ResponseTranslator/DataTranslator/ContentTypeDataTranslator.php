<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator;

use PHPAPILibrary\Core\Data\ResponseInterface;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateResponseException;
use PHPAPILibrary\Core\Network\Response\Response;
use PHPAPILibrary\Core\Network\In\ResponseTranslator\DataTranslatorInterface;
use PHPAPILibrary\Http\HttpResponse;
use Psr\Http\Message\StreamInterface;

/**
 * Class ContentTypeDataTranslator
 * @package PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator
 */
class ContentTypeDataTranslator implements DataTranslatorInterface
{
    protected const MIME_TYPE_JSON =  "application/json";
    protected const MIME_URLENCODED = "application/x-www-form-urlencoded";

    /**
     * @var JsonDataTranslator
     */
    protected $jsonDataTranslator;
    /**
     * @var UrlEncodedDataTranslator
     */
    private $urlEncodedDataTranslator;

    /**
     * ContentTypeDataTranslator constructor.
     * @param JsonDataTranslator $jsonDataTranslator
     * @param UrlEncodedDataTranslator $urlEncodedDataTranslator
     */
    public function __construct(JsonDataTranslator $jsonDataTranslator, UrlEncodedDataTranslator $urlEncodedDataTranslator)
    {
        $this->jsonDataTranslator = $jsonDataTranslator;
        $this->urlEncodedDataTranslator = $urlEncodedDataTranslator;
    }

    /**
     * @param ResponseInterface $response
     * @return StreamInterface
     * @throws UnableToTranslateResponseException
     */
    public function translateData(ResponseInterface $response): StreamInterface
    {
        if(!($response instanceof HttpResponse)){
            throw new UnableToTranslateResponseException(
                Response::getNullResponse(),
                "A ContentTypeDataTranslator can only translate HttpResponses."
            );
        }

        $translator = $this->getTranslatorByContentTypeHeader(
            $response->getResponse()->getHeaderLine("Content-type") ?: null
        );

        if(!$response->getData()->getSize()) {
            return null;
        } elseif($response->getData()->getSize() && !$translator) {
            throw new UnableToTranslateResponseException(
                Response::getNullResponse(),
                "Content-type unknown; unable to parse request data"
            );
        } else {
            return $translator->translateData($response);
        }
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
                return $this->jsonDataTranslator;
            case self::MIME_URLENCODED:
                return $this->urlEncodedDataTranslator;
            default:
                return null;
        }
    }
}
