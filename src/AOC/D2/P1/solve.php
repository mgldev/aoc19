<?php

namespace AOC\D2\P1;

/**
 * Class Instruction
 *
 * @package AOC\D2\P1
 */
abstract class Instruction
{
    /** @var Program */
    private $program;

    /** @var int */
    private $readPositionOne;

    /** @var int */
    private $readPositionTwo;

    /** @var int */
    private $writePosition;

    /**
     * Instruction constructor.
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

    abstract public function getWriteValue(): int;
}

class

/**
 * Class Program
 */
class Program
{
    /** @var array */
    private $data = [];

    /**
     * Program constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param int $position
     *
     * @return int
     */
    public function read(int $position): int
    {
        return $this->data[$position];
    }

    /**
     * @param int $position
     *
     * @param int $value
     */
    public function write(int $position, int $value)
    {
        $this->data[$position] = $value;
    }

    /**
     * @param string $filename
     *
     * @return Program
     */
    public static function fromFile(string $filename): self
    {
        $data = explode(',', file_get_contents($filename));

        return new self($data);
    }

    public function getInstructions(): array
    {
        $instructions = array_chunk($this->data, 4);
        list ($opCode, $readPositionOne, $readPositionTwo, $storePosition) =
    }
}

$program = Program::fromFile(__DIR__ . '/input.txt');


