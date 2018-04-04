<?php
namespace PHPAPILibrary\Http\In;

use PHPAPILibrary\Core\Network\AccessControllerInterface;
use PHPAPILibrary\Core\Network\CacheControllerInterface;
use PHPAPILibrary\Core\Network\LoggerInterface;
use PHPAPILibrary\Core\Network\RateControllerInterface;
use PHPAPILibrary\Core\Network\RouterInterface;
use PHPAPILibrary\Http\AbstractRoutingLayerController;

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
     * @param AccessControllerInterface $accessController
     * @param CacheControllerInterface $cacheController
     * @param RateControllerInterface $rateController
     * @param LoggerInterface $logger
     * @internal param ClientInterface $client
     */
    public function __construct(
        RouterInterface $router,
        AccessControllerInterface $accessController,
        CacheControllerInterface $cacheController,
        RateControllerInterface $rateController,
        LoggerInterface $logger
    )
    {
        $this->accessController = $accessController;
        $this->cacheController = $cacheController;
        $this->rateController = $rateController;
        $this->logger = $logger;
        $this->router = $router;
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
