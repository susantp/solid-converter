<?php

namespace Techbizz\UnitConverterModule;

use Techbizz\UnitConverterModule\Converters\GramToKiloGramConverter;
use Techbizz\UnitConverterModule\Converters\KilogramToGramConverter;

class UnitConverterFactory
{
    public function makeConverter(
        UnitEnum $fromUnit,
        UnitEnum $toUnit,
    ): UnitConverterInterface|string {
//        $class = ${$fromUnit}.'To'.${$toUnit};
//        return new $class();
        if ($fromUnit->value == UnitEnum::KG_UNIT->value && $toUnit->value == UnitEnum::G_UNIT->value) {
            return new KilogramToGramConverter();
        }
        if ($fromUnit->value == UnitEnum::G_UNIT->value && $toUnit->value == UnitEnum::KG_UNIT->value) {
            return new GramToKiloGramConverter();
        }
        return sprintf('%s', 'No Converter Available.');
    }
}