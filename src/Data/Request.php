<?php
namespace PHPAPILibrary\Http\Data;

use PHPAPILibrary\Core\Data\DataInterface;
use PHPAPILibrary\Core\Data\IdentityInterface;
use PHPAPILibrary\Core\Data\RequestInterface;

class Request implements RequestInterface
{
    /**
     * @var String
     */
    private $verb;
    /**
     * @var String
     */
    private $path;
    /**
     * @var null|IdentityInterface
     */
    private $identity;
    /**
     * @var DataInterface
     */
    private $data;

    /**
     * Request constructor.
     * @param String $verb
     * @param String $path
     * @param null|IdentityInterface $identity
     * @param DataInterface $data
     */
    public function __construct(
        String $verb,
        String $path,
        ?IdentityInterface $identity,
        DataInterface $data
    )
    {
        $this->verb = $verb;
        $this->path = $path;
        $this->identity = $identity;
        $this->data = $data;
    }

    /**
     * @return String
     */
    public function getVerb(): String
    {
        return $this->verb;
    }

    /**
     * @return String
     */
    public function getPath(): String
    {
        return $this->path;
    }

    /**
     * @return null|IdentityInterface
     */
    public function getIdentity(): ?IdentityInterface
    {
        return $this->identity;
    }

    /**
     * @return DataInterface
     */
    public function getData(): DataInterface
    {
        return $this->data;
    }
}
