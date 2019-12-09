<?php

namespace AOC\D2\P1;

require_once __DIR__ . '/../../../../vendor/autoload.php';

for ($noun = 0; $noun < 100; $noun++) {
    for ($verb = 0; $verb < 100; $verb++) {
        $output = Program::fromFile(__DIR__ . '/../P1/input.txt')
            ->write(1, $noun)
            ->write(2, $verb)
            ->execute()
            ->read(0);

        if ($output === 19690720) {
            $answer = (100 * $noun) + $verb;
            echo "Answer is $answer\n";
        }
    }
}
