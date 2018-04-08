<?php
namespace PHPAPILibrary\Http\In\RequestTranslator;

use PHPAPILibrary\Core\Network\In\RequestTranslator\IdentityProvider\NullIdentityProvider;
use PHPAPILibrary\Core\Network\In\RequestTranslator\IdentityProviderInterface;
use PHPAPILibrary\Core\Network\RequestInterface;
use PHPAPILibrary\Http\In\ContentTypeDataTranslatorProvider;

class RequestTranslator extends AbstractRequestTranslator
{
    /**
     * @var null|ContentTypeDataTranslatorProvider
     */
    private $dataTranslatorProvider;
    /**
     * @var null|IdentityProviderInterface
     */
    private $identityProvider;

    /**
     * RequestTranslator constructor.
     * @param null|ContentTypeDataTranslatorProvider $dataTranslatorProvider - If null a default will be used.
     * @param null|IdentityProviderInterface $identityProvider - If null a NullIdentityProvider will be used.
     */
    public function __construct(
        ?ContentTypeDataTranslatorProvider $dataTranslatorProvider = null,
        ?IdentityProviderInterface $identityProvider = null
    )
    {
        if($dataTranslatorProvider === null) {
            $dataTranslatorProvider = new ContentTypeDataTranslatorProvider();
        }

        if($identityProvider === null) {
            $identityProvider = new NullIdentityProvider();
        }

        $this->dataTranslatorProvider = $dataTranslatorProvider;
        $this->identityProvider = $identityProvider;
    }

    /**
     * @return ContentTypeDataTranslatorProvider
     */
    protected function getContentTypeDataTranslatorProvider(): ContentTypeDataTranslatorProvider
    {
        return $this->dataTranslatorProvider;
    }

    /**
     * @param RequestInterface $request
     * @return IdentityProviderInterface
     */
    protected function getIdentityProvider(RequestInterface $request): IdentityProviderInterface
    {
        return $this->identityProvider;
    }
}
