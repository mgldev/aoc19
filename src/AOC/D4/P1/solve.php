<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use AOC\D4\P1\NumericRange;
use AOC\D4\P1\Password;

$rangeString = file_get_contents(__DIR__ . '/input.txt');
$passwordLength = 6;
$validPasswords = 0;

foreach (NumericRange::fromString($rangeString, $passwordLength) as $passwordAttempt) {
    try {
        new Password($passwordAttempt);
        $validPasswords++;
    } catch (InvalidArgumentException $invalidArgumentException) {
        continue;
    }
}

echo "Answer is $validPasswords\n";