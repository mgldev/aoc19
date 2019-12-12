<?php

namespace AOC\D3\P1;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$grid = new CentralisedGrid(2505);

foreach (file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES) as $index => $instructions) {
    $snake = new Snake(++$index, $grid);
    $snake->navigateFromString($instructions);
}

$output = (new HtmlGridRenderer())->render($grid);
file_put_contents('/home/michael/grid.html', $output);
echo 'Done';