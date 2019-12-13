<?php

namespace AOC\D3\P1;

/**
 * Class GridReference
 *
 * @package AOC\D3\P1
 */
class GridReference
{
    /** @var int */
    private $x;

    /** @var int */
    private $y;

    /**
     * GridReference constructor.
     *
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param GridReference $gridReference
     *
     * @return bool
     */
    public function equals(GridReference $gridReference): bool
    {
        return $this->getX() === $gridReference->getX() && $this->getY() == $gridReference->getY();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getX() . ',' . $this->getY();
    }
}
