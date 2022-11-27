<?php

namespace Techbizz\UnitConverterModule\Converters;

class RopaniToAanaConverter implements \Techbizz\UnitConverterModule\Interfaces\UnitConverterInterface
{

    public function convert(float|int $value): float|int
    {
        return $value * 16;
    }
}