<?php

namespace Techbizz\UnitConverterModule;

class UnitConverterManager
{
    public function __construct(protected UnitConverterFactory $converterFactory)
    {
    }

    public function convert(UnitEnum $fromUnit, UnitEnum $toUnit, float|int $value): int|float
    {
        return $this
            ->converterFactory
            ->makeConverter($fromUnit, $toUnit)
            ->convert($value);
    }

}