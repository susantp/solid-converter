<?php

namespace Techbizz\UnitConverterModule\Factories;

use Exception;
use Techbizz\UnitConverterModule\Interfaces\UnitConverterInterface;
use Techbizz\UnitConverterModule\Enums\UnitEnum;

class UnitConverterFactory
{
    private const CONVERTER_NAMESPACE = 'Techbizz\UnitConverterModule\Converters';
    private const CONVERTERS_DIRECTORY = './src/techbizz/unit-converter-module/Converters';

    public function __construct(private array $converterMap = [])
    {
        $this->mapConverters();
    }

    private function mapConverters(): void
    {
        $converterFilesLs = scandir(self::CONVERTERS_DIRECTORY);
        $converterFiles = array_slice($converterFilesLs, 2);
        $this->converterMap = array_map(
            function ($filename) {
                $converterNameSpace = self::CONVERTER_NAMESPACE;
                $class = explode('.', $filename);
                return [$class[0], sprintf('%s\\%s', $converterNameSpace, $class[0])];
            },
            $converterFiles
        );
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