<?php

namespace Techbizz\UnitConverterModule;

use Exception;

class UnitConverterManager
{
    public function __construct(protected UnitConverterFactory $converterFactory)
    {
    }

    /**
     * @throws Exception
     */
    public function convert(UnitEnum $fromUnit, UnitEnum $toUnit, float|int $value): int|float
    {
        return number_format(
            (float)$this
                ->converterFactory
                ->makeConverter($fromUnit, $toUnit)
                ->convert($value),
            '3',
            '.'
        );
    }

}