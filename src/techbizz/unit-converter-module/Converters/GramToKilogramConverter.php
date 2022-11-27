<?php

namespace Techbizz\UnitConverterModule\Converters;

use Techbizz\UnitConverterModule\Interfaces\UnitConverterInterface;

class GramToKilogramConverter implements UnitConverterInterface
{

    public function convert(float|int $value): float|int
    {
        return $value / 1000;
    }
}