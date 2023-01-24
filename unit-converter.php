<?php
require_once "vendor/autoload.php";

use Techbizz\UnitConverterModule\Controllers\MainController;

if (!$argc) {
    echo "sorry";
    return 0;
};
$argArray = getopt('f:t:v:', ['fromUnit:toUnit:value:']);
$controller = new MainController();

try {
    echo $controller->validate($argArray)->convert();
} catch (Exception $e) {
    echo $e->getMessage();
}


