<?php
require_once "vendor/autoload.php";

use Techbizz\UnitConverterModule\UnitConverter;
use Techbizz\UnitConverterModule\UnitConverterFactory;

$fromUnit = 'Gram';
$toUnit = 'KiloGram';
$value = '2000';

$converter = new UnitConverter(new UnitConverterFactory());
$convertedValue = $converter->convert($fromUnit, $toUnit, $value);
$fromUnit = $convertedValue > 1 ? sprintf('%ss', $fromUnit) : $fromUnit;
$toUnit = $convertedValue > 1 ? sprintf('%ss', $toUnit) : $toUnit;
echo sprintf('%s%s is %s%s'.PHP_EOL, $value, $fromUnit, $convertedValue, $toUnit);
//echo "$value $fromUnit is  $value $toUnit".PHP_EOL;
