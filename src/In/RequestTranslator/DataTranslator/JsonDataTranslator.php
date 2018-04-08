<?php
namespace PHPAPILibrary\Http\In\RequestTranslator\DataTranslator;

use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Http\HttpResponse;
use Psr\Http\Message\StreamInterface;

/**
 * A Data Translator adapter for the PHP json_decode method.
 * Class JsonDataTranslator
 * @package PHPAPILibrary\Http\In\RequestTranslator\DataTranslator
 */
class JsonDataTranslator extends AbstractDataTranslator
{
    /**
     * @var bool
     */
    private $associative;
    /**
     * @var int
     */
    private $depth;
    /**
     * @var int
     */
    private $options;

    /**
     * JsonDataTranslator constructor.
     * @param bool $associative [optional] <p>
     * When <b>TRUE</b>, returned objects will be converted into
     * associative arrays.
     * </p>
     * @param int $depth [optional] <p>
     * User specified recursion depth.
     * </p>
     * @param int $options [optional] <p>
     * Bitmask of JSON decode options. Currently only
     * <b>JSON_BIGINT_AS_STRING</b>
     * is supported (default is to cast large integers as floats)
     * </p>
     */
    public function __construct($associative = true, $depth = 512, $options = 0)
    {
        $this->associative = $associative;
        $this->depth = $depth;
        $this->options = $options;
    }

    /**
     * @param StreamInterface $stream
     * @return mixed the value encoded in <i>json</i> in appropriate
     * PHP type. Values true, false and
     * null (case-insensitive) are returned as <b>TRUE</b>, <b>FALSE</b>
     * and <b>NULL</b> respectively. <b>NULL</b> is returned if the
     * <i>json</i> cannot be decoded or if the encoded
     * data is deeper than the recursion limit.
     * @throws UnableToTranslateRequestException
     */
    protected function translateRequestBody(StreamInterface $stream)
    {
        try {
            return \GuzzleHttp\json_decode($stream->getContents(), $this->associative, $this->depth, $this->options);
        } catch (\InvalidArgumentException $exception) {
            throw new UnableToTranslateRequestException(new HttpResponse(new \GuzzleHttp\Psr7\Response(400)), $exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
