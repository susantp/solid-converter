<?php

namespace Techbizz\UnitConverterModule\Controllers;

use Exception;
use Techbizz\UnitConverterModule\Enums\UnitEnum;
use Techbizz\UnitConverterModule\Interfaces\UnitConverterInterface;
use Techbizz\UnitConverterModule\Managers\UnitConverterManager;

class MainController
{
    protected const INVALID_ARGS_MSG = "Argument Error!!! eg: -f, -t, -v";
    protected const INVALID_UNIT_MSG = "Invalid unit given to convert. Only %s units are supported.";
    protected const SUCCESS_MSG = '%.3f %s is %.3f %s';

    private const ARGUMENT_COUNT = 3;

    protected UnitEnum $fromUnit;
    protected UnitEnum $toUnit;

    protected int|float $value;

    /**
     * @throws Exception
     */
    public function validate($argumentArray = []): MainController
    {
        if (count($argumentArray) != self::ARGUMENT_COUNT) throw new Exception(self::INVALID_ARGS_MSG . PHP_EOL);

        $matchingFromUnitIndex = array_search($argumentArray['f'], array_column(UnitEnum::cases(), 'value'));
        $matchingToUnitIndex = array_search($argumentArray['t'], array_column(UnitEnum::cases(), 'value'));

        if (!($matchingFromUnitIndex && $matchingToUnitIndex)) {
            throw new Exception(sprintf(self::INVALID_UNIT_MSG, $this->getAvailableUnits()) . PHP_EOL);
        }

        $this->fromUnit = UnitEnum::from($argumentArray['f']);
        $this->toUnit = UnitEnum::from($argumentArray['t']);
        $this->value = $argumentArray['v'];
        return $this;
    }

    /**
     * @throws Exception
     */
    public function convert(): string
    {
        $converter = $this->getUnitConverter($this->fromUnit, $this->toUnit);
        $convertedValue = $converter->convert($this->value);

        $fromUnitString = $this->fromUnit->value > 1 ? sprintf('%ss', $this->fromUnit->value) : $this->fromUnit->value;
        $toUnitString = $convertedValue > 1 ? sprintf('%ss', $this->toUnit->value) : $this->toUnit->value;

        return sprintf(self::SUCCESS_MSG, $this->value, $fromUnitString, $convertedValue, $toUnitString) . PHP_EOL;
    }

    public function getAvailableUnits(): string
    {
        return implode(',', array_column(UnitEnum::cases(), "value"));
    }

    /**
     * @param UnitEnum $fromUnit
     * @param UnitEnum $toUnit
     * @return Exception|UnitConverterInterface
     * @throws Exception
     */
    public function getUnitConverter(UnitEnum $fromUnit, UnitEnum $toUnit): UnitConverterInterface|Exception
    {
        $converterManager = new UnitConverterManager();
        return $converterManager->getConverter($this->fromUnit, $this->toUnit);
    }

}