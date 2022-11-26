<?php

namespace Techbizz\UnitConverterModule;

use Exception;

class UnitConverterFactory
{

    /**
     * @throws Exception
     */
    public function makeConverter(UnitEnum $fromUnit, UnitEnum $toUnit,): UnitConverterInterface|Exception
    {
        $converterClass = sprintf(
            "Techbizz\UnitConverterModule\Converters\%sTo%sConverter",
            $fromUnit->value,
            $toUnit->value);

        if (!class_exists($converterClass)) {
            throw new Exception("Converter not available.");
        }

        return new $converterClass();
    }
}