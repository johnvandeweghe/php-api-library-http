<?php
namespace PHPAPILibrary\Http\Data;

use PHPAPILibrary\Core\CacheControlInterface;
use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Data\ResponseInterface;
use PHPAPILibrary\Http\ResponseDataInterface;

class Response implements ResponseInterface
{
    /**
     * @var CacheControlInterface
     */
    private $cacheControl;
    /**
     * @var ResponseData
     */
    private $responseData;

    /**
     * Response constructor.
     * @param ResponseData|null $responseData
     * @param CacheControlInterface $cacheControl
     */
    public function __construct(?ResponseData $responseData, ?CacheControlInterface $cacheControl = null)
    {
        if($cacheControl === null) {
            $cacheControl = new \PHPAPILibrary\Core\CacheControl\NoCacheControl();
        }

        $this->cacheControl = $cacheControl;
        $this->responseData = $responseData;
    }

    /**
     * @return CacheControlInterface
     */
    public function getCacheControl(): CacheControlInterface
    {
        return $this->cacheControl;
    }

    /**
     * @return DataInterface|null
     */
    public function getData(): ?DataInterface
    {
        return $this->responseData;
    }

    /**
     * @return ResponseDataInterface|null
     */
    public function getHttpData(): ?ResponseDataInterface
    {
        return $this->responseData;
    }
}
