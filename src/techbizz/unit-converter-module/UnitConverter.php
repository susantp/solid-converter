<?php

namespace Techbizz\UnitConverterModule;

class UnitConverter
{
    public function __construct(public UnitConverterFactory $converterFactory)
    {
    }

    public function convert(string $fromUnit, string $toUnit, int $value): int
    {
        $converter = $this->converterFactory->getConverter($fromUnit, $toUnit);
        return $converter->convert($value);
    }

}