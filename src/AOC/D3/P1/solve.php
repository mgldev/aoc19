<?php

namespace AOC\D3\P1;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$grid = new Grid();

$wireColours = ['#ffb480', '#6d3580'];

foreach (file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES) as $index => $instructions) {
    $wire = new Wire($index, $grid, $wireColours[$index]);
    $wire->navigateFromString($instructions);
}

$answer = (new ClosestIntersectionCalculator)->calculate($grid);

echo "Answer is $answer\n\n";

$twig = new Environment(new FilesystemLoader(__DIR__ . '/views'));
$filename = '/home/michael/Desktop/day3.html';
$highchartConfig = (new HighchartGenerator)->generate($grid);
$html = $twig->render(
    'visualisation.html.twig',
    [
        'config' => $highchartConfig,
        'closestDistance' => $answer
    ]
);

file_put_contents($filename, $html);

echo "Visualisation output to $filename\n";