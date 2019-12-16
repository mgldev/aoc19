<?php

namespace AOC\D4\P1;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * Class NumericRange
 *
 * @package AOC\D4\P1
 */
class NumericRange implements IteratorAggregate
{
    /** @var array */
    private $range = [];

    /**
     * NumericRange constructor.
     *
     * @param int $min
     * @param int $max
     * @param int $length
     */
    public function __construct(int $min, int $max, int $length)
    {
        for ($i = $min; $i <= $max; $i++) {
            $this->range[] = str_pad($i, $length, '0', STR_PAD_RIGHT);
        }
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->range);
    }

    /**
     * @param string $range
     * @param int $length
     *
     * @return NumericRange
     */
    public static function fromString(string $range, int $length): self
    {
        list($min, $max) = explode('-', $range);

        return new self($min, $max, $length);
    }
}
