<?php

namespace Techbizz\UnitConverterModule\Converters;

class RopaniToAanaConverter implements \Techbizz\UnitConverterModule\UnitConverterInterface
{

    public function convert(float|int $value): float|int
    {
        return $value * 16;
    }
}