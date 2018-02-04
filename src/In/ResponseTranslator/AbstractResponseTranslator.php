<?php
namespace PHPAPILibrary\Http\In\ResponseTranslator;

use PHPAPILibrary\Core\Network\In\ResponseTranslator\DataTranslatorInterface;
use PHPAPILibrary\Http\In\ResponseTranslator\DataTranslator\ContentTypeDataTranslator;

/**
 * Class AbstractResponseTranslator
 * @package PHPAPILibrary\Http\In
 */
abstract class AbstractResponseTranslator extends \PHPAPILibrary\Core\Network\In\ResponseTranslator\AbstractResponseTranslator
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
