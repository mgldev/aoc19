<?php

namespace AOC\D2\P1;

/**
 * Class MultiplyInstruction
 *
 * @package AOC\D2\P1
 */
class MultiplyInstruction extends AbstractInstruction
{
    /**
     * @return int
     */
    public function getWriteValue(): int
    {
        $a = $this->program->read($this->readPositionOne);
        $b = $this->program->read($this->readPositionTwo);

        return $a * $b;
    }
}
