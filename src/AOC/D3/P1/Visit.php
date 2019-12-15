<?php

namespace AOC\D3\P1;

/**
 * Class Visit
 *
 * @package AOC\D3\P1
 */
class Visit
{
    /** @var int */
    private $stepsTravelled;

    /** @var Wire */
    private $wire;

    /**
     * Visit constructor.
     * @param int $stepsTravelled
     * @param Wire $wire
     */
    public function __construct(int $stepsTravelled, Wire $wire)
    {
        $this->stepsTravelled = $stepsTravelled;
        $this->wire = $wire;
    }

    /**
     * @return int
     */
    public function getStepsTravelled(): int
    {
        return $this->stepsTravelled;
    }

    /**
     * @return Wire
     */
    public function getWire(): Wire
    {
        return $this->wire;
    }
}
