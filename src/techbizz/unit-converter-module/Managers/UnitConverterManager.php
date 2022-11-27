<?php

namespace Techbizz\UnitConverterModule\Managers;

use Exception;
use Techbizz\UnitConverterModule\Factories\UnitConverterFactory;
use Techbizz\UnitConverterModule\Enums\UnitEnum;

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
        return $this
            ->converterFactory
            ->makeConverter($fromUnit, $toUnit)
            ->convert($value);
    }

}