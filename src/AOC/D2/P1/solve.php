<?php

namespace AOC\D2\P1;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$answer = Program::fromFile(__DIR__ . '/input.txt')
    ->write(1, 12)
    ->write(2, 2)
    ->execute()
    ->read(0);

echo 'Answer is ' . $answer;