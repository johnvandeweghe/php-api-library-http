<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator;

use function GuzzleHttp\Psr7\stream_for;
use PHPAPILibrary\Http\HttpResponse;
use PHPAPILibrary\Http\In\ResponseTranslator\Exception\UnableToTranslateResponseException;
use Psr\Http\Message\StreamInterface;

/**
 * A Data Translator adapter for the PHP json_encode method.
 * Class JsonDataTranslator
 * @package PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator
 */
class JsonDataTranslator extends AbstractDataTranslator
{
    /**
     * @var int
     */
    private $options;
    /**
     * @var int
     */
    private $depth;

    /**
     * JsonDataTranslator constructor.
     * @param int    $options JSON encode option bitmask
     * @param int    $depth   Set the maximum depth. Must be greater than zero.
     */
    public function __construct($options = 0, $depth = 512)
    {
        $this->options = $options;
        $this->depth = $depth;
    }

    /**
     * @param mixed $responseData
     * @return StreamInterface
     * @throws UnableToTranslateResponseException
     */
    protected function translateRequestBody($responseData): StreamInterface
    {
        try {
            return stream_for(\GuzzleHttp\json_encode($responseData, $this->options, $this->depth));
        } catch (\InvalidArgumentException $exception) {
            throw new UnableToTranslateResponseException(
                new HttpResponse(new \GuzzleHttp\Psr7\Response(400)),
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }
    }
}
