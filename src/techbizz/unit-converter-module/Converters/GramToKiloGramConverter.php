<?php

namespace Techbizz\UnitConverterModule\Converters;

use Techbizz\UnitConverterModule\UnitConverterInterface;

class GramToKiloGramConverter implements UnitConverterInterface
{

    public function convert(int $value): float
    {
        return $value / 1000;
    }
}