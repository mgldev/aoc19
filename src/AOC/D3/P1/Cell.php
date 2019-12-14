<?php

namespace AOC\D3\P1;

use Countable;

/**
 * Class WireCell
 *
 * @package AOC\D3\P1
 */
class Cell
{
    /** @var GridReference */
    private $gridReference;

    /** @var Wire[] */
    private $wires = [];

    /**
     * Cell constructor.
     *
     * @param GridReference $gridReference
     */
    public function __construct(GridReference $gridReference)
    {
        $this->gridReference = $gridReference;
    }

    /**
     * @return GridReference
     */
    public function getGridReference(): GridReference
    {
        return $this->gridReference;
    }

    /**
     * @param Wire $wire
     *
     * @return $this
     */
    public function addWire(Wire $wire)
    {
        $this->wires[$wire->getId()] = $wire;

        return $this;
    }

    /**
     * @return Wire[]
     */
    public function getWires(): array
    {
        return $this->wires;
    }

    /**
     * @return bool
     */
    public function hasWires(): bool
    {
        return count($this->getWires()) > 0;
    }

    /**
     * @return array
     */
    public function getUniqueWires(): array
    {
        return array_unique($this->getWires());
    }

    /**
     * @return bool
     */
    public function hasIntersections(): bool
    {
        return count($this->getUniqueWires()) > 1;
    }

    /**
     * @return bool
     */
    public function hasOverlaps(): bool
    {
        return count($this->getWires()) > 1 && !$this->hasIntersections();
    }

    /**
     * @param int $position
     *
     * @return Wire
     */
    public function getWire(int $position): Wire
    {
        $wires = array_values($this->wires);

        return $wires[$position];
    }
}
