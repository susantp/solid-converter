<?php

namespace Techbizz\UnitConverterModule\Factories;

use Exception;
use Techbizz\UnitConverterModule\Interfaces\UnitConverterInterface;
use Techbizz\UnitConverterModule\Enums\UnitEnum;

class UnitConverterFactory
{

    public function __construct(
        private readonly array $converterMap = [
            ['AanaToRopaniConverter', '\\Techbizz\\UnitConverterModule\\Converters\\AanaToRopaniConverter'],
            ['GramToKilogramConverter', '\\Techbizz\\UnitConverterModule\\Converters\\GramToKilogramConverter'],
            ['KilogramToGramConverter', '\\Techbizz\\UnitConverterModule\\Converters\\KilogramToGramConverter'],
            ['RopaniToAanaConverter', '\\Techbizz\\UnitConverterModule\\Converters\\RopaniToAanaConverter']
        ]
    ) {
    }

    /**
     * @throws Exception
     */
    public function makeConverter(UnitEnum $fromUnit, UnitEnum $toUnit,): UnitConverterInterface|Exception
    {
        $converterClassConvention = sprintf("%sTo%sConverter", ucfirst($fromUnit->value), ucfirst($toUnit->value));

        $requestedClassContainer = array_filter(
            $this->converterMap,
            function ($requestedClassArray) use ($converterClassConvention) {
                return $converterClassConvention === $requestedClassArray[0];
            }
        );

        if (!count($requestedClassContainer)) {
            throw new Exception("$fromUnit->value to $toUnit->value converter not available.".PHP_EOL);
        }

        $converterClass = array_shift($requestedClassContainer);

        return new $converterClass[1]();
    }
}