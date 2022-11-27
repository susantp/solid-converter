<?php
require_once "vendor/autoload.php";

use Techbizz\UnitConverterModule\UnitConverterManager;
use Techbizz\UnitConverterModule\UnitConverterFactory;
use Techbizz\UnitConverterModule\UnitEnum;

if (!$argc) {
    echo "sorry";
    return 0;
};
$argumentArray = getopt('f:t:v:', ['fromUnit:toUnit:value:']);

$fromUnit = UnitEnum::from(trim($argumentArray['f']));
$toUnit = UnitEnum::from(trim($argumentArray['t']));
$value = trim($argumentArray['v']);

$converterManager = new UnitConverterManager(new UnitConverterFactory());
try {
    $convertedValue = $converterManager->convert($fromUnit, $toUnit, $value);

    $fromUnit = $convertedValue > 1 ? sprintf('%ss', $fromUnit->value) : $fromUnit;
    $toUnit = $convertedValue > 1 ? sprintf('%ss', $toUnit->value) : $toUnit;

    echo sprintf('%.3f %s is %.3f %s'.PHP_EOL, $value, $fromUnit, $convertedValue, $toUnit);
} catch (Exception $e) {
    echo $e->getMessage();
}


