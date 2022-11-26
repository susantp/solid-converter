<?php

namespace Techbizz\UnitConverterModule;

interface UnitConverterInterface
{

    public function convert(float|int $value);
}