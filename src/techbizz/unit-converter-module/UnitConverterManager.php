<?php

namespace Techbizz\UnitConverterModule;

class UnitConverterManager
{
    public function __construct(protected UnitConverterFactory $converterFactory)
    {
    }

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