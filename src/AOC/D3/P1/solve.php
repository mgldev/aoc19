<?php

namespace AOC\D3\P1;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$grid = new Grid(6, 6);

$snake1 = new Snake(1, $grid, new GridReference(2, 2));
$snake1->up(2)->right(2)->down(4)->left(2);

$snake2 = new Snake(2, $grid, new GridReference(2, 2));
$snake2->left(2)->up(1)->right(3);

echo (new GridRenderer)->render($grid);