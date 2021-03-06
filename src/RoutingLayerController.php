<?php
namespace PHPAPILibrary\Http;

use PHPAPILibrary\Core\Network\AccessController\AllowAllAccessController;
use PHPAPILibrary\Core\Network\AccessControllerInterface;
use PHPAPILibrary\Core\Network\CacheController\NullCacheController;
use PHPAPILibrary\Core\Network\CacheControllerInterface;
use PHPAPILibrary\Core\Network\Logger\NullLogger;
use PHPAPILibrary\Core\Network\LoggerInterface;
use PHPAPILibrary\Core\Network\RateController\NoRateController;
use PHPAPILibrary\Core\Network\RateControllerInterface;
use PHPAPILibrary\Core\Network\RouterInterface;

class RoutingLayerController extends AbstractRoutingLayerController
{
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
     * @var RouterInterface
     */
    private $router;

    /**
     * LayerController constructor.
     * @param RouterInterface $router
     * @param AccessControllerInterface|null $accessController
     * @param CacheControllerInterface|null $cacheController
     * @param RateControllerInterface|null $rateController
     * @param LoggerInterface $logger
     * @internal param ClientInterface $client
     */
    public function __construct(
        RouterInterface $router,
        ?AccessControllerInterface $accessController = null,
        ?CacheControllerInterface $cacheController = null,
        ?RateControllerInterface $rateController = null,
        ?LoggerInterface $logger = null
    )
    {
        $this->router = $router;

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

        $this->accessController = $accessController;
        $this->cacheController = $cacheController;
        $this->rateController = $rateController;
        $this->logger = $logger;
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

    /**
     * @return RouterInterface
     */
    protected function getRouter(): RouterInterface
    {
        return $this->router;
    }
}
