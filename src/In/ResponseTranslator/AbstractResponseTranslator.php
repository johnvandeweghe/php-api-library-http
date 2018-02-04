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
    protected function getDataTranslator(): DataTranslatorInterface
    {
        return $this->getContentTypeDataTranslator();
    }

    abstract protected function getContentTypeDataTranslator(): ContentTypeDataTranslator;

}
