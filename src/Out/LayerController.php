<?php
namespace PHPAPILibrary\Http\Out;

use GuzzleHttp\ClientInterface;
use PHPAPILibrary\Core\Network\AccessController\AllowAllAccessController;
use PHPAPILibrary\Core\Network\AccessControllerInterface;
use PHPAPILibrary\Core\Network\CacheController\NullCacheController;
use PHPAPILibrary\Core\Network\CacheControllerInterface;
use PHPAPILibrary\Core\Network\Logger\NullLogger;
use PHPAPILibrary\Core\Network\LoggerInterface;
use PHPAPILibrary\Core\Network\RateController\NoRateController;
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
        ?AccessControllerInterface $accessController = null,
        ?CacheControllerInterface $cacheController = null,
        ?RateControllerInterface $rateController = null,
        ?LoggerInterface $logger = null
    )
    {

        if($accessController === null) {
            $accessController = new AllowAllAccessController();
        }

        if($cacheController === null) {
            $cacheController = new NullCacheController();
        }

        if($rateController === null) {
            $rateController = new NoRateController();
        }

        if($logger === null) {
            $logger = new NullLogger();
        }

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
