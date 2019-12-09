<?php

namespace AOC\D2\P1;

/**
 * Class AbstractInstruction
 *
 * @package AOC\D2\P1
 */
abstract class AbstractInstruction
{
    /** @var Program */
    protected $program;

    /** @var int */
    protected $readPositionOne;

    /** @var int */
    protected $readPositionTwo;

    /** @var int */
    protected $writePosition;

    /**
     * AbstractInstruction constructor.
     *
     * @param Program $program
     * @param int $readPositionOne
     * @param int $readPositionTwo
     * @param int $writePosition
     */
    public function __construct(
        Program $program,
        int $readPositionOne,
        int $readPositionTwo,
        int $writePosition
    ) {
        $this->program = $program;
        $this->readPositionOne = $readPositionOne;
        $this->readPositionTwo = $readPositionTwo;
        $this->writePosition = $writePosition;
    }

    /**
     * Execute the instruction
     */
    public function execute()
    {
        $this->program->write($this->writePosition, $this->getWriteValue());
    }

    /**
     * Calculate the the value to write for this instruction
     *
     * @return int
     */
    abstract public function getWriteValue(): int;
}
