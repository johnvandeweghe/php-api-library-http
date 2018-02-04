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
    protected function getDataTranslator(): DataTranslatorInterface
    {
        return $this->getContentTypeDataTranslator();
    }

    abstract protected function getContentTypeDataTranslator(): ContentTypeDataTranslator;

}
