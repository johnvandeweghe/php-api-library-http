<?php
class ExampleLambdaController extends \PHPAPILibrary\Core\Network\AbstractLambdaLayerController
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
     * @param \PHPAPILibrary\Core\Network\RequestInterface $request
     * @return callable function(RequestInterface): ResponseInterface
     */
    protected function getCallable(\PHPAPILibrary\Core\Network\RequestInterface $request): callable
    {
        return $this->callable;
    }

    /**
     * @return \PHPAPILibrary\Core\Network\AccessControllerInterface
     */
    protected function getAccessController(): \PHPAPILibrary\Core\Network\AccessControllerInterface
    {
        return new \PHPAPILibrary\Core\Network\AccessController\AllowAllAccessController();
    }

    /**
     * @return \PHPAPILibrary\Core\Network\CacheControllerInterface
     */
    protected function getCacheController(): \PHPAPILibrary\Core\Network\CacheControllerInterface
    {
        return new \PHPAPILibrary\Core\Network\CacheController\NullCacheController();
    }

    /**
     * @return \PHPAPILibrary\Core\Network\RateControllerInterface
     */
    protected function getRateController(): \PHPAPILibrary\Core\Network\RateControllerInterface
    {
        return new \PHPAPILibrary\Core\Network\RateController\NoRateController();
    }

    /**
     * @return \PHPAPILibrary\Core\Network\LoggerInterface
     */
    protected function getLogger(): \PHPAPILibrary\Core\Network\LoggerInterface
    {
        return new \PHPAPILibrary\Core\Network\Logger\NullLogger();
    }
}
