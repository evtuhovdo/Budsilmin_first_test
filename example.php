<?php

use Budsilnim\SportMatchTest;
use Budsilnim\TestPointCalculator;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Budsilnim/SportMatchTest.php';


$testPoints = new TestPointCalculator(
    10,
    TestPointCalculator::MALE,
    TestPointCalculator::MESOMORPH,
    170,
    45,
    TestPointCalculator::ART_PSYCHOLOGY,
    90,
    TestPointCalculator::GOOD_FLEXIBILITY,
    100,
    300,
    175,
    172
);

// Данные чтобы понять ТТХ ребенка
$testPointsRes = $testPoints->data();
print_r($testPointsRes);

$test = new SportMatchTest();

// Данные чтобы понять какие виды спорта ему подходят
$res = $test->getResult(
    10,
    TestPointCalculator::MALE,
    TestPointCalculator::MESOMORPH,
    170,
    45,
    TestPointCalculator::ART_PSYCHOLOGY,
    90,
    TestPointCalculator::GOOD_FLEXIBILITY,
    100,
    300,
    175,
    172
);

print_r($res);

