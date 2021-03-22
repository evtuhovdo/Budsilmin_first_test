<?php

use Budsilnum\ResultCalculator;
use Budsilnum\SportMatchTest;
use Budsilnum\TestPointCalculator;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Budsilnum/SportMatchTest.php';

$resultCalculator = new ResultCalculator();

$test = new SportMatchTest();
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

