<?php
namespace PHPAPILibrary\Http\In;

use PHPAPILibrary\Core\Network\In\RequestTranslator\DataTranslatorInterface;

abstract class AbstractRequestTranslator extends \PHPAPILibrary\Core\Network\In\RequestTranslator\AbstractRequestTranslator
{
    protected function getDataTranslator(): DataTranslatorInterface
    {
        // TODO: Implement getDataTranslator() method.
    }
}
