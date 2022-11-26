<?php
require_once "vendor/autoload.php";

use Techbizz\UnitConverterModule\UnitConverterManager;
use Techbizz\UnitConverterModule\UnitConverterFactory;
use Techbizz\UnitConverterModule\UnitEnum;

$fromUnit = UnitEnum::G_UNIT;
$toUnit = UnitEnum::KG_UNIT;
$value = 2500;

$converterManager = new UnitConverterManager(new UnitConverterFactory());
$convertedValue = $converterManager->convert($fromUnit, $toUnit, $value);

$fromUnit = $convertedValue > 1 ? sprintf('%ss', $fromUnit->value) : $fromUnit;
$toUnit = $convertedValue > 1 ? sprintf('%ss', $toUnit->value) : $toUnit;

echo sprintf('%.3f %s is %.3f %s'.PHP_EOL, $value, $fromUnit, $convertedValue, $toUnit);
//echo "$value $fromUnit is  $value $toUnit".PHP_EOL;
