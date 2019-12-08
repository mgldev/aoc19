<?php

namespace AOC\D1\P1;

require_once __DIR__ . '/../../../../vendor/autoload.php';

echo FuelCounterUpper::fromFile(__DIR__ . '/input.txt')->getTotalFuelRequired() . "\n";