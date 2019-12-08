<?php

namespace AOC\D1\P2;

use AOC\D1\P1\FuelCounterUpper;

require_once __DIR__ . '/../../../../vendor/autoload.php';

echo FuelCounterUpper::fromFile(
    __DIR__ . '/input.txt',
    RecursiveFuelModule::class
)->getTotalFuelRequired() . "\n";