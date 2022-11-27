<?php

namespace Techbizz\UnitConverterModule\Factories;

use Exception;
use Techbizz\UnitConverterModule\Interfaces\UnitConverterInterface;
use Techbizz\UnitConverterModule\Enums\UnitEnum;

class UnitConverterFactory
{

    /**
     * @throws Exception
     */
    public function makeConverter(UnitEnum $fromUnit, UnitEnum $toUnit,): UnitConverterInterface|Exception
    {
        $converterClass = sprintf(
            "%s\Converters\%sTo%sConverter",
            $GLOBALS['moduleVariables']['baseNamespace'],
            $fromUnit->value,
            $toUnit->value);

        if (!class_exists($converterClass)) {
            throw new Exception("$fromUnit->value to $toUnit->value converter not available.".PHP_EOL);
        }

        return new $converterClass();
    }
}