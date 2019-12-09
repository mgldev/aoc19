<?php

namespace AOC\D2\P1;

use InvalidArgumentException;

/**
 * Class Program
 *
 * @package AOC\D2\P1
 */
class Program
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function read(int $position): int
    {
        if (!isset($this->data[$position])) {
            throw new InvalidArgumentException('Invalid program position #' . $position);
        }

        return $this->data[$position];
    }

    public function write(int $position, int $value)
    {
        if (!isset($this->data[$position])) {
            throw new InvalidArgumentException('Invalid program position #' . $position);
        }

        $this->data[$position] = $value;
    }
}
