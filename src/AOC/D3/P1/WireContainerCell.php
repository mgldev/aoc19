<?php

namespace AOC\D3\P1;

use Countable;

/**
 * Class WireContainerCell
 *
 * @package AOC\D3\P1
 */
class WireContainerCell extends Cell implements Countable
{
    /** @var Wire[] */
    private $wires;

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
     * @param int $position
     *
     * @return Wire
     */
    public function getWire(int $position): Wire
    {
        return $this->wires[$position];
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->wires);
    }
}
