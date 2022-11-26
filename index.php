<?php
require_once "vendor/autoload.php";

use Techbizz\UnitConverterModule\UnitConverterManager;
use Techbizz\UnitConverterModule\UnitConverterFactory;
use Techbizz\UnitConverterModule\UnitEnum;

$fromUnit = 'Gram';
$toUnit = 'KiloGram';
$value = 2500;

$converterManager = new UnitConverterManager(new UnitConverterFactory());
$convertedValue = $converterManager->convert(UnitEnum::KG_UNIT, UnitEnum::G_UNIT, $value);

$fromUnit = $convertedValue > 1 ? sprintf('%ss', $fromUnit) : $fromUnit;
$toUnit = $convertedValue > 1 ? sprintf('%ss', $toUnit) : $toUnit;

echo sprintf('%f %s is %f %s'.PHP_EOL, $value, $fromUnit, $convertedValue, $toUnit);
//echo "$value $fromUnit is  $value $toUnit".PHP_EOL;
