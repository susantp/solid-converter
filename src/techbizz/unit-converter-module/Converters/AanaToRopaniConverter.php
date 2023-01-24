<?php

namespace Techbizz\UnitConverterModule\Converters;

use Techbizz\UnitConverterModule\Interfaces\UnitConverterInterface;

class AanaToRopaniConverter implements UnitConverterInterface
{

    public function convert(float|int $value): float|int
    {
        return $value / 16;
    }
}
