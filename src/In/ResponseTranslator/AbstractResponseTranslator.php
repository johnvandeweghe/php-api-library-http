<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator;

use GuzzleHttp\Psr7\Response;
use HansOtt\PSR7Cookies\SetCookie;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateResponseException;
use PHPAPILibrary\Core\Network\ResponseInterface;
use PHPAPILibrary\Core\Network\In\ResponseTranslator\DataTranslatorInterface;
use PHPAPILibrary\Http\HttpResponse;
use Psr\Http\Message\StreamInterface;

/**
 * Class AbstractResponseTranslator
 * @package PHPAPILibrary\Http\In
 */
abstract class AbstractResponseTranslator extends \PHPAPILibrary\Core\Network\In\ResponseTranslator\AbstractResponseTranslator
{
    /**
     * @param \PHPAPILibrary\Core\Data\ResponseInterface $response
     * @return DataTranslatorInterface
     * @throws UnableToTranslateResponseException
     */
    protected function getDataTranslator(\PHPAPILibrary\Core\Data\ResponseInterface $response): DataTranslatorInterface
    {
        if (!($response instanceof \PHPAPILibrary\Http\Data\Response)){
            throw new UnableToTranslateResponseException(
                new HttpResponse(new \GuzzleHttp\Psr7\Response(500)),
                'A ResponseTranslator can only translate \PHPAPILibrary\Http\Data\Responses.'
            );
        }

        $translatorProvider = $this->getContentTypeDataTranslatorProvider();
        $translator = $translatorProvider->getDataTranslator($response);

        if(!$translator) {
            throw new UnableToTranslateResponseException(
                new HttpResponse(new \GuzzleHttp\Psr7\Response(500)),
                "Unknown content-type."
            );
        }

        return $translator;
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
        if (!($response instanceof \PHPAPILibrary\Http\Data\Response)){
            throw new UnableToTranslateResponseException(
                new HttpResponse(new \GuzzleHttp\Psr7\Response(500)),
                'A ResponseTranslator can only translate \PHPAPILibrary\Http\Data\Responses.'
            );
        }

        $psrCookies = array_map(
            function($key, $value) {
                //TODO: Actually support all of the cookie fields...
                return new SetCookie($key, $value);
            },
            array_keys($response->getHttpData()->getCookies()),
            $response->getHttpData()->getCookies()
        );

        $response = new Response(
            $response->getHttpData()->getStatusCode(),
            $response->getHttpData()->getHeaders(),
            $data
        );

        $response = array_reduce($psrCookies, function($response, SetCookie $cookie) {
            return $cookie->addToResponse($response);
        }, $response);

        return new HttpResponse($response);
    }

    /**
     * @return ContentTypeDataTranslatorProvider
     */
    abstract protected function getContentTypeDataTranslatorProvider(): ContentTypeDataTranslatorProvider;


}
