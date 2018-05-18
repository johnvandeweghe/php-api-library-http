<?php
class ExampleLambdaDataController extends \PHPAPILibrary\Core\Data\AbstractLambdaLayerController
{
    /**
     * @var callable
     */
    private $callable;

    /**
     * WebServer constructor.
     * @param callable $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * @param \PHPAPILibrary\Core\Data\RequestInterface $request
     * @return callable function(RequestInterface): ResponseInterface
     */
    protected function getCallable(\PHPAPILibrary\Core\Data\RequestInterface $request): callable
    {
        return $this->callable;
    }

    /**
     * @return \PHPAPILibrary\Core\Data\AccessControllerInterface
     */
    protected function getAccessController(): \PHPAPILibrary\Core\Data\AccessControllerInterface
    {
        return new \PHPAPILibrary\Core\Data\AccessController\AllowAllAccessController();
    }

    /**
     * @return \PHPAPILibrary\Core\Data\CacheControllerInterface
     */
    protected function getCacheController(): \PHPAPILibrary\Core\Data\CacheControllerInterface
    {
        return new \PHPAPILibrary\Core\Data\CacheController\NullCacheController();
    }

    /**
     * @return \PHPAPILibrary\Core\Data\RateControllerInterface
     */
    protected function getRateController(): \PHPAPILibrary\Core\Data\RateControllerInterface
    {
        return new \PHPAPILibrary\Core\Data\RateController\NoRateController();
    }

    /**
     * @return \PHPAPILibrary\Core\Data\LoggerInterface
     */
    protected function getLogger(): \PHPAPILibrary\Core\Data\LoggerInterface
    {
        return new \PHPAPILibrary\Core\Data\Logger\NullLogger();
    }

}
