<?php
namespace PHPAPILibrary\Http\Out;

use GuzzleHttp\ClientInterface;
use PHPAPILibrary\Core\Network\AccessControllerInterface;
use PHPAPILibrary\Core\Network\CacheControllerInterface;
use PHPAPILibrary\Core\Network\LoggerInterface;
use PHPAPILibrary\Core\Network\RateControllerInterface;

/**
 * Class LayerController
 * @package PHPAPILibrary\Http\Out
 */
class LayerController extends AbstractLayerController
{
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var AccessControllerInterface
     */
    private $accessController;
    /**
     * @var CacheControllerInterface
     */
    private $cacheController;
    /**
     * @var RateControllerInterface
     */
    private $rateController;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * LayerController constructor.
     * @param ClientInterface $client
     * @param AccessControllerInterface $accessController
     * @param CacheControllerInterface $cacheController
     * @param RateControllerInterface $rateController
     * @param LoggerInterface $logger
     */
    public function __construct(
        ClientInterface $client,
        AccessControllerInterface $accessController,
        CacheControllerInterface $cacheController,
        RateControllerInterface $rateController,
        LoggerInterface $logger
    )
    {
        $this->client = $client;
        $this->accessController = $accessController;
        $this->cacheController = $cacheController;
        $this->rateController = $rateController;
        $this->logger = $logger;
    }

    /**
     * @return ClientInterface
     */
    protected function getGuzzleClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @return AccessControllerInterface
     */
    protected function getAccessController(): AccessControllerInterface
    {
        return $this->accessController;
    }

    /**
     * @return CacheControllerInterface
     */
    protected function getCacheController(): CacheControllerInterface
    {
        return $this->cacheController;
    }

    /**
     * @return RateControllerInterface
     */
    protected function getRateController(): RateControllerInterface
    {
        return $this->rateController;
    }

    /**
     * @return LoggerInterface
     */
    protected function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}
