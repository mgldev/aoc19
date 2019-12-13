<?php

namespace AOC\D3\P1;

require_once __DIR__ . '/../../../../vendor/autoload.php';

echo "Creating grid\n";

$grid = new CentralisedGrid(355, new WireContainerCellGenerator);
$centerGridReference = $grid->getCenterGridReference();

echo "Grid created - centre is at $centerGridReference.\n";

$input = file_get_contents(__DIR__ . '/input.txt');
$instructionSet = explode(PHP_EOL, $input);

foreach ($instructionSet as $index => $instructions) {
    echo "Creating wire $index\n";
    $wire = new Wire(++$index, $grid);
    echo "Navigating wire $index\n";
    $wire->navigateFromString($instructions);
    echo "Navigation complete.\n";
}

echo "Rendering grid.\n";
$filename = (new HtmlGridRenderer)->render($grid, ['filename' => '/home/michael/Desktop/grid.html']);
echo "Rendering complete.\n";
echo 'Done';