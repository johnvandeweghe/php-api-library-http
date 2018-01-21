<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator;

use function GuzzleHttp\Psr7\stream_for;
use PHPAPILibrary\Core\Identity\ResponseInterface;
use PHPAPILibrary\Core\Network\In\Exception\UnableToTranslateRequestException;
use PHPAPILibrary\Core\Network\In\ResponseTranslator\DataTranslatorInterface;
use PHPAPILibrary\Core\Network\Response\Response;
use Psr\Http\Message\StreamInterface;

/**
 * A Data Translator adapter for the PHP json_encode method.
 * Class JsonDataTranslator
 * @package PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator
 */
class JsonDataTranslator implements DataTranslatorInterface
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
     * @param ResponseInterface $response
     * @return StreamInterface
     * @throws UnableToTranslateRequestException
     */
    public function translateData(ResponseInterface $response): StreamInterface
    {
        try {
            return stream_for(\GuzzleHttp\json_encode($response->getData(), $this->options, $this->depth));
        } catch (\InvalidArgumentException $exception) {
            throw new UnableToTranslateRequestException(Response::getNullResponse(), $exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
