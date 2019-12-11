<?php

namespace AOC\D3\P1;

/**
 * Class Visit
 *
 * @package AOC\D3\P1
 */
class Visit
{
    /** @var string */
    private $direction;

    /** @var Snake */
    private $snake;

    /**
     * Visit constructor.
     *
     * @param string $direction
     * @param Snake $snake
     */
    public function __construct(string $direction, Snake $snake)
    {
        $this->direction = $direction;
        $this->snake = $snake;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @return Snake
     */
    public function getSnake(): Snake
    {
        return $this->snake;
    }
}
