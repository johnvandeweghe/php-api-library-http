<?php
namespace PHPAPILibrary\Http\Out;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\TransferException;
use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Core\Network\Response\Response;
use PHPAPILibrary\Core\Network\ResponseInterface;
use PHPAPILibrary\Http\HttpRequest;
use PHPAPILibrary\Http\HttpResponse;

/**
 * A GuzzleHttp Client adapter.
 * Class AbstractLayerController
 * @package PHPAPILibrary\Http\Out
 */
abstract class AbstractLayerController extends \PHPAPILibrary\Core\Network\AbstractLayerController
{

    /**
     * @param RequestInterface $request
     * @return HttpResponse - Always returns HttpResponse
     * @throws RequestException
     * @throws UnableToProcessRequestException
     */
    protected function getResponse(RequestInterface $request): ResponseInterface
    {
        if(!($request instanceof HttpRequest)) {
            throw new UnableToProcessRequestException(Response::getNullResponse(), "Unable to handle non HTTP requests.");
        }
        /**
         * @var HttpRequest $request
         */

        try {
            $response = $this->getGuzzleClient()->send($request->getRequest(), [
                "http_errors" => false
            ]);

            return new HttpResponse($response);
        } catch (TransferException $transferException) {
            throw new UnableToProcessRequestException(
                Response::getNullResponse(),
                $transferException->getMessage(),
                $transferException->getCode(),
                $transferException
            );
        }
    }

    /**
     * @return ClientInterface
     */
    abstract protected function getGuzzleClient(): ClientInterface;
}
