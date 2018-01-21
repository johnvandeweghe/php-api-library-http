<?php
namespace PHPAPILibrary\Http\In;

use PHPAPILibrary\Core\Network\Response\Response;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\In\RequestTranslator\DataTranslatorInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Http\HttpRequest;

class ContentTypeDataTranslator implements DataTranslatorInterface
{

    /**
     * @param RequestInterface $request
     * @return object|array|null
     * @throws UnableToTranslateRequestException
     */
    public function translateData(RequestInterface $request)
    {
        if(!($request instanceof HttpRequest)){
            throw new UnableToTranslateRequestException(Response::getNullResponse(), "A ContentTypeDataTranslator can only translate HTTPRequests.");
        }

        
    }
}
