<?php
namespace PHPAPILibrary\Http\In;

use PHPAPILibrary\Core\Data\LayerControllerInterface;
use PHPAPILibrary\Core\Network\AccessController\AllowAllAccessController;
use PHPAPILibrary\Core\Network\AccessControllerInterface;
use PHPAPILibrary\Core\Network\CacheController\NullCacheController;
use PHPAPILibrary\Core\Network\CacheControllerInterface;
use PHPAPILibrary\Core\Network\In\RequestTranslatorInterface;
use PHPAPILibrary\Core\Network\In\ResponseTranslatorInterface;
use PHPAPILibrary\Core\Network\Logger\NullLogger;
use PHPAPILibrary\Core\Network\LoggerInterface;
use PHPAPILibrary\Core\Network\RateController\NoRateController;
use PHPAPILibrary\Core\Network\RateControllerInterface;
use PHPAPILibrary\Http\In\RequestTranslator\RequestTranslator;
use PHPAPILibrary\Http\In\ResponseTranslator\ResponseTranslator;

class LayerController extends AbstractLayerController
{
    /**
     * @var LayerControllerInterface
     */
    private $nextLayer;
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
     * @var null|RequestTranslator
     */
    private $requestTranslator;
    /**
     * @var null|ResponseTranslator
     */
    private $responseTranslator;

    /**
     * LayerController constructor.
     * @param LayerControllerInterface $nextLayer
     * @param null|RequestTranslator $requestTranslator
     * @param null|ResponseTranslator $responseTranslator
     * @param null|AccessControllerInterface $accessController
     * @param null|CacheControllerInterface $cacheController
     * @param null|RateControllerInterface $rateController
     * @param null|LoggerInterface $logger
     */
    public function __construct(
        LayerControllerInterface $nextLayer,
        ?RequestTranslator $requestTranslator = null,
        ?ResponseTranslator $responseTranslator = null,
        ?AccessControllerInterface $accessController = null,
        ?CacheControllerInterface $cacheController = null,
        ?RateControllerInterface $rateController = null,
        ?LoggerInterface $logger = null
    )
    {
        if($requestTranslator === null) {
            $requestTranslator = new RequestTranslator();
        }

        if($responseTranslator === null) {
            $responseTranslator = new ResponseTranslator();
        }

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
        $this->nextLayer = $nextLayer;
        $this->requestTranslator = $requestTranslator;
        $this->responseTranslator = $responseTranslator;
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
     * @return RequestTranslatorInterface
     */
    protected function getRequestTranslator(): RequestTranslatorInterface
    {
        return $this->requestTranslator;
    }

    /**
     * @return ResponseTranslatorInterface
     */
    protected function getResponseTranslator(): ResponseTranslatorInterface
    {
        return $this->responseTranslator;
    }

    /**
     * @return \PHPAPILibrary\Core\Data\LayerControllerInterface
     */
    protected function getNextLayer(): \PHPAPILibrary\Core\Data\LayerControllerInterface
    {
        return $this->nextLayer;
    }
}
