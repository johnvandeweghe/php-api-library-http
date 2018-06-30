<?php
namespace PHPAPILibrary\Http\Data;

use PHPAPILibrary\Core\Data\Exception\AccessDeniedException;
use PHPAPILibrary\Core\Data\Exception\RateLimitExceededException;
use PHPAPILibrary\Core\Data\Exception\RequestException;
use PHPAPILibrary\Core\Data\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Core\Data\RequestInterface;
use PHPAPILibrary\Core\Data\ResponseInterface;

abstract class AbstractLayerController extends \PHPAPILibrary\Core\Data\AbstractLayerController
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
        return new Response(new ResponseData(409));
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
        return new Response(new ResponseData(409));
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws RequestException
     * @throws UnableToProcessRequestException
     */
    protected function getResponse(RequestInterface $request): ResponseInterface
    {
        if(!($request instanceof Request)) {
            throw new RequestException(new Response(new ResponseData(400)));
        }

        return $this->getHttpDataResponse($request);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws RequestException
     * @throws UnableToProcessRequestException
     */
    abstract protected function getHttpDataResponse(Request $request): Response;
}
