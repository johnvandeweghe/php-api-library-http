<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator;

class ResponseTranslator extends AbstractResponseTranslator
{
    /**
     * @var null|ContentTypeDataTranslatorProvider
     */
    private $dataTranslatorProvider;

    /**
     * ResponseTranslator constructor.
     * @param null|ContentTypeDataTranslatorProvider $dataTranslatorProvider - If null a default will be used.
     */
    public function __construct(
        ?ContentTypeDataTranslatorProvider $dataTranslatorProvider = null
    )
    {
        if($dataTranslatorProvider === null) {
            $dataTranslatorProvider = new ContentTypeDataTranslatorProvider();
        }

        $this->dataTranslatorProvider = $dataTranslatorProvider;
    }

    /**
     * @return ContentTypeDataTranslatorProvider
     */
    protected function getContentTypeDataTranslatorProvider(): ContentTypeDataTranslatorProvider
    {
        return $this->dataTranslatorProvider;
    }
}
