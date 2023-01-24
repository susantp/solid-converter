<?php

namespace Techbizz\UnitConverterModule\Interfaces;

interface UnitConverterInterface
{

    public function convert(float|int $value): float|int;
}
