<?php

namespace Techbizz\UnitConverterModule\Converters;

use Techbizz\UnitConverterModule\UnitConverterInterface;

class KilogramToGramConverter implements UnitConverterInterface
{

    public function convert(float|int $value): float|int
    {
        return $value * 1000;
    }
}