<?php

namespace Techbizz\UnitConverterModule\Converters;

class AanaToRopaniConverter implements \Techbizz\UnitConverterModule\UnitConverterInterface
{

    public function convert(float|int $value): float|int
    {
        return $value / 16;
    }
}