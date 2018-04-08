<?php
namespace PHPAPILibrary\Http\In\RequestTranslator;

use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Data\IdentityInterface;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\In\RequestTranslator\DataTranslatorInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Http\Data\Request;
use PHPAPILibrary\Http\HttpRequest;
use PHPAPILibrary\Http\HttpResponse;
use PHPAPILibrary\Http\In\ContentTypeDataTranslatorProvider;

/**
 * Class AbstractContentTypeRequestTranslator
 * @package PHPAPILibrary\Http\In
 */
abstract class AbstractRequestTranslator extends \PHPAPILibrary\Core\Network\In\RequestTranslator\AbstractRequestTranslator
{

    /**
     * @param RequestInterface $request
     * @return DataTranslatorInterface
     * @throws UnableToTranslateRequestException
     */
    protected function getDataTranslator(RequestInterface $request): DataTranslatorInterface
    {
        if (!($request instanceof HttpRequest)) {
            throw new UnableToTranslateRequestException(
                new HttpResponse(new \GuzzleHttp\Psr7\Response(400)),
                "A ContentTypeRequestTranslator can only translate HTTPRequests."
            );
        }

        $translatorProvider = $this->getContentTypeDataTranslatorProvider();
        $translator = $translatorProvider->getDataTranslator($request);

        if(!$translator) {
            throw new UnableToTranslateRequestException(
                new HttpResponse(new \GuzzleHttp\Psr7\Response(400)),
                "Unknown content-type."
            );
        }

        return $translator;
    }

    /**
     * @param null|IdentityInterface $identity
     * @param DataInterface $data
     * @param RequestInterface $request
     * @return \PHPAPILibrary\Core\Data\RequestInterface
     */
    protected function buildRequest(
        ?IdentityInterface $identity,
        DataInterface $data,
        RequestInterface $request
    ): \PHPAPILibrary\Core\Data\RequestInterface {
        return new Request($request->getVerb(), $request->getPath(), $identity, $data);
    }

    /**
     * @return ContentTypeDataTranslatorProvider
     */
    abstract protected function getContentTypeDataTranslatorProvider(): ContentTypeDataTranslatorProvider;
}
