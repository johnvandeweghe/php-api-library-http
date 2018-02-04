<?php
namespace PHPAPILibrary\Http\In\RequestTranslator;

use PHPAPILibrary\Core\Network\In\RequestTranslator\DataTranslatorInterface;
use PHPAPILibrary\Http\In\RequestTranslator\DataTranslator\ContentTypeDataTranslator;

/**
 * Class AbstractResponseTranslator
 * @package PHPAPILibrary\Http\In
 */
abstract class AbstractRequestTranslator extends \PHPAPILibrary\Core\Network\In\RequestTranslator\AbstractRequestTranslator
{
    /**
     * @return DataTranslatorInterface
     */
    protected function getDataTranslator(): DataTranslatorInterface
    {
        return $this->getContentTypeDataTranslator();
    }

    /**
     * @return ContentTypeDataTranslator
     */
    abstract protected function getContentTypeDataTranslator(): ContentTypeDataTranslator;

}
