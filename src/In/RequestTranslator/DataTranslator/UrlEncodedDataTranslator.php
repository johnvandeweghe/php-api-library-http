<?php
namespace PHPAPILibrary\Http\In\RequestTranslator\DataTranslator;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\In\RequestTranslator\DataTranslatorInterface;
use PHPAPILibrary\Core\Network\RequestInterface;

/**
 * Treat the request body as form-urlencoded.
 * NOTE: Because of the underlying use of http://php.net/manual/en/function.parse-str.php this function converts dots
 * in keys to underscores. I.E. cool.var=123 will become [cool_var => 123]
 */
class UrlEncodedDataTranslator implements DataTranslatorInterface
{

    /**
     * Treat the request body as form-urlencoded.
     * NOTE: Because of the underlying use of http://php.net/manual/en/function.parse-str.php this function converts dots
     * in keys to underscores. I.E. cool.var=123 will become [cool_var => 123]
     * @param RequestInterface $request
     * @return object|array|null
     * @throws UnableToTranslateRequestException
     */
    public function translateData(RequestInterface $request)
    {
        $result = [];

        parse_str($request->getData()->getContents(), $result);

        return $result;
    }
}
