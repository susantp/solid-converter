<?php

namespace Techbizz\UnitConverterModule\Factories;

use Exception;
use Techbizz\UnitConverterModule\Interfaces\UnitConverterInterface;
use Techbizz\UnitConverterModule\Enums\UnitEnum;

class UnitConverterFactory
{

    public function __construct(private array $converterMap = [])
    {
        $this->mapConverters();
    }

    private function mapConverters(): void
    {
        $converterNameSpace = $_ENV['CONVERTER_NAMESPACE'];
        $converterFilesLs = scandir('./src/techbizz/unit-converter-module/Converters');
        $converterFiles = array_slice($converterFilesLs, 2);
        $this->converterMap = array_map(
            function ($filename) use ($converterNameSpace) {
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