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

    /** @var Visit[] */
    private $visits = [];

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
     * @param Visit $visit
     *
     * @return $this
     */
    public function addVisit(Visit $visit)
    {
        $wireId = $visit->getWire()->getId();

        if (!isset($this->visits[$wireId])) {
            $this->visits[$wireId] = [];
        }
        $this->visits[$wireId][] = $visit;

        return $this;
    }

    /**
     * @return Visit[]
     */
    public function getVisits(): array
    {
        return $this->visits;
    }

    /**
     * @return bool
     */
    public function hasVisits(): bool
    {
        return count($this->getVisits()) > 0;
    }

    /**
     * @return array
     */
    public function getUniqueWires(): array
    {
        $wires = [];

        foreach ($this->visits as $wireId => $visits) {
            /** @var Visit $visit */
            foreach ($visits as $visit) {
                $wires[] = $visit->getWire();
            }
        }

        return array_unique($wires);
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
        return count($this->getVisits()) > 1 && !$this->hasIntersections();
    }

    /**
     * @param int $position
     *
     * @return Visit|null
     */
    public function getVisit(int $position)
    {
        $visits = array_values($this->visits);

        return $visits[$position];
    }
}
