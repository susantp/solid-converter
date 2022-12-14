<?php
require_once "vendor/autoload.php";

use Techbizz\UnitConverterModule\Factories\UnitConverterFactory;
use Techbizz\UnitConverterModule\Managers\UnitConverterManager;
use Techbizz\UnitConverterModule\Enums\UnitEnum;

const BASE_NAMESPACE = 'Techbizz\UnitConverterModule';
const CONVERTER_NAMESPACE = 'Techbizz\UnitConverterModule\Converters';

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

    $fromUnit = $convertedValue > 0 ? sprintf('%ss', $fromUnit->value) : $fromUnit->value;
    $toUnit = $convertedValue > 0 ? sprintf('%ss', $toUnit->value) : $toUnit->value;

    echo sprintf('%.3f %s is %.3f %s'.PHP_EOL, $value, $fromUnit, $convertedValue, $toUnit);
} catch (Exception $e) {
    echo $e->getMessage();
}


