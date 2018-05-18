<?php
namespace PHPAPILibrary\Http\In\RequestTranslator\DataTranslator;

use GuzzleHttp\Psr7\ServerRequest;
use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\In\RequestTranslator\DataTranslatorInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Http\Data\RequestData;
use PHPAPILibrary\Http\HttpRequest;
use PHPAPILibrary\Http\HttpResponse;
use PHPAPILibrary\Http\RequestDataInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class ContentTypeDataTranslator
 * @package PHPAPILibrary\Http\In\RequestTranslator\DataTranslator
 */
abstract class AbstractDataTranslator implements DataTranslatorInterface
{
    /**
     * @param RequestInterface $request
     * @return DataInterface
     * @throws UnableToTranslateRequestException
     */
    public function translateData(RequestInterface $request): DataInterface
    {
        if(!($request instanceof HttpRequest)){
            throw new UnableToTranslateRequestException(
                new HttpResponse(new \GuzzleHttp\Psr7\Response(400)),
                "A DataTranslator can only translate HTTPRequests."
            );
        }

        return $this->buildRequestData($this->buildServerRequest($request));
    }

    /**
     * @param HttpRequest $request
     * @return ServerRequestInterface
     * @throws UnableToTranslateRequestException
     */
    protected function buildServerRequest(HttpRequest $request): ServerRequestInterface
    {
        $psrRequest = $request->getRequest();

        $serverRequest = new ServerRequest(
            $psrRequest->getMethod(),
            $psrRequest->getUri(),
            $psrRequest->getHeaders(),
            $psrRequest->getBody(),
            $psrRequest->getProtocolVersion()
        );

        return $serverRequest->withParsedBody($this->translateRequestBody($request->getData()));
    }

    /**
     * @param ServerRequestInterface $serverRequest
     * @return RequestDataInterface
     */
    protected function buildRequestData(ServerRequestInterface $serverRequest): RequestDataInterface
    {
        return new RequestData($serverRequest);
    }

    /**
     * @param StreamInterface $stream
     * @return mixed
     * @throws UnableToTranslateRequestException
     */
    abstract protected function translateRequestBody(StreamInterface $stream);
}
