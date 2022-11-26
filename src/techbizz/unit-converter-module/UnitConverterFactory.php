<?php

namespace Techbizz\UnitConverterModule;

use Techbizz\UnitConverterModule\Converters\GramToKiloGramConverter;
use Techbizz\UnitConverterModule\Converters\KilogramToGramConverter;

class UnitConverterFactory
{
    public function getConverter(string $from = 'kg', string $to = 'g'): UnitConverterInterface
    {
        if ($from == UnitEnum::KG_UNIT->value && $to == UnitEnum::G_UNIT->value) {
            return new KilogramToGramConverter();
        }
        if ($from == UnitEnum::G_UNIT->value && $to == UnitEnum::KG_UNIT->value) {
            return new GramToKiloGramConverter();
        }
        throw new \InvalidArgumentException(
            sprintf('%s', 'No Converter Available.')
        );
    }
}