<?php

namespace AOC\D2\P1;

/**
 * Class AddInstruction
 *
 * @package AOC\D2\P1
 */
class AddInstruction extends AbstractInstruction
{
    /**
     * @return int
     */
    public function getWriteValue(): int
    {
        $a = $this->program->read($this->readPositionOne);
        $b = $this->program->read($this->readPositionTwo);

        return $a + $b;
    }
}
