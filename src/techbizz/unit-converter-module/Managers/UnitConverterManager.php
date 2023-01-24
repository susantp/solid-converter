<?php

namespace Techbizz\UnitConverterModule\Managers;

use Exception;
use Techbizz\UnitConverterModule\Factories\UnitConverterFactory;
use Techbizz\UnitConverterModule\Enums\UnitEnum;
use Techbizz\UnitConverterModule\Interfaces\UnitConverterInterface;

class UnitConverterManager
{
    /**
     * @throws Exception
     */
    public function getConverter(UnitEnum $fromUnit, UnitEnum $toUnit): Exception|UnitConverterInterface
    {
        return (new UnitConverterFactory())->makeConverter($fromUnit, $toUnit);
    }

}