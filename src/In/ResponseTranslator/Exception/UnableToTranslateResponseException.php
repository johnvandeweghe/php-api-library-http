<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator\Exception;

use PHPAPILibrary\Core\Network\Exception\UnableToProcessRequestException;
use PHPAPILibrary\Http\HttpResponse;

/**
 * Class UnableToTranslateResponseException
 * @package PHPAPILibrary\Http\In\ResponseTranslator\Exception
 */
class UnableToTranslateResponseException extends \PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateResponseException
{
    /**
     * UnableToTranslateResponseException constructor.
     * @param HttpResponse $response
     * @param string $message
     * @param int $code
     * @param null $previous
     */
    public function __construct(HttpResponse $response, $message = "", $code = 0, $previous = null)
    {
        UnableToProcessRequestException::__construct($response, $message, $code, $previous);
    }

}
