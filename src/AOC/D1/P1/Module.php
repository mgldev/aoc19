<?php

namespace AOC\D1\P1;

/**
 * Class Module
 *
 * @package AOC\D1\P1
 */
class Module
{
    /** @var int */
    private $mass;

    /**
     * Module constructor.
     *
     * @param int $mass
     */
    public function __construct(int $mass)
    {
        $this->mass = $mass;
    }

    /**
     * @return int
     */
    public function getFuelRequired(): int
    {
        return floor($this->mass / 3) - 2;
    }
}
