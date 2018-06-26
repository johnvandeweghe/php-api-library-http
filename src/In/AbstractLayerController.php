<?php
namespace PHPAPILibrary\Http\In;

use GuzzleHttp\Psr7\Response;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Core\Network\ResponseInterface;
use PHPAPILibrary\Core\Network\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Network\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Network\Exception\RequestException;
use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Http\HttpResponse;

abstract class AbstractLayerController extends \PHPAPILibrary\Core\Network\In\AbstractLayerController
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws RateLimitExceededException
     * @throws UnableToProcessRequestException
     */
    protected function handleRateLimitExceeded(RequestInterface $request): ResponseInterface
    {
        return new HttpResponse(new Response(409));
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws AccessDeniedException
     * @throws UnableToProcessRequestException
     */
    protected function handleDeniedAccess(RequestInterface $request): ResponseInterface
    {
        return new HttpResponse(new Response(403));
    }
}
