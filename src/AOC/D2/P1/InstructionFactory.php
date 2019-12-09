<?php

namespace AOC\D2\P1;

use RuntimeException;

/**
 * Class InstructionFactory
 *
 * @package AOC\D2\P1
 */
class InstructionFactory
{
    /** @var int */
    const OP_CODE_ADD = 1;

    /** @var int */
    const OP_CODE_MULTIPLY = 2;

    /** @var int */
    const OP_CODE_HALT = 99;

    /**
     * Create an instruction from an instruction data array
     *
     * @param Program $program
     * @param array $instruction
     *
     * @return AbstractInstruction
     */
    public static function fromArray(Program $program, array $instruction): AbstractInstruction
    {
        list ($opCode, $readPositionOne, $readPositionTwo, $writePosition) = $instruction;

        switch ($opCode) {
            case self::OP_CODE_ADD:
                return new AddInstruction($program, $readPositionOne, $readPositionTwo, $writePosition);

            case self::OP_CODE_MULTIPLY:
                return new MultiplyInstruction($program, $readPositionOne, $readPositionTwo, $writePosition);

            case self::OP_CODE_HALT:
                throw new RuntimeException('Halting!');
        }
    }
}
