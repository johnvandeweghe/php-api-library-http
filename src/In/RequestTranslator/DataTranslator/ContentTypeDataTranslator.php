<?php
namespace PHPAPILibrary\Http\In\RequestTranslator\DataTranslator;

use PHPAPILibrary\Core\Network\Response\Response;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\In\RequestTranslator\DataTranslatorInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Http\HttpRequest;

/**
 * Class ContentTypeDataTranslator
 * @package PHPAPILibrary\Http\In\RequestTranslator\DataTranslator
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
     * @param RequestInterface $request
     * @return object|array|null
     * @throws UnableToTranslateRequestException
     */
    public function translateData(RequestInterface $request)
    {
        if(!($request instanceof HttpRequest)){
            throw new UnableToTranslateRequestException(
                Response::getNullResponse(),
                "A ContentTypeDataTranslator can only translate HTTPRequests."
            );
        }

        $translator = $this->getTranslatorByContentTypeHeader(
            $request->getRequest()->getHeaderLine("Content-type") ?: null
        );

        if(!$request->getData()->getSize()) {
            return null;
        } elseif($request->getData()->getSize() && !$translator) {
            throw new UnableToTranslateRequestException(
                Response::getNullResponse(),
                "Content-type unknown; unable to parse request data"
            );
        } else {
            return $translator->translateData($request);
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
