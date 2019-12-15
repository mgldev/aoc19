<?php

namespace AOC\D3\P1;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use AOC\D3\P2\FewestCombinedStepsCalculator;

$grid = new Grid();

foreach (file(__DIR__ . '/../P1/input.txt', FILE_IGNORE_NEW_LINES) as $index => $instructions) {
    $wire = new Wire($index, $grid);
    $wire->navigateFromString($instructions);
}

$answer = (new FewestCombinedStepsCalculator)->calculate($grid);

echo "Answer is $answer\n\n";