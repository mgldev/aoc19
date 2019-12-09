<?php

namespace AOC\D2\P1;

use RuntimeException;

/**
 * Class Program
 *
 * @package AOC\D2\P1
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
     *
     * @return Program
     */
    public function write(int $position, int $value): self
    {
        $this->data[$position] = $value;

        return $this;
    }

    /**
     * Create a program from a given $filename
     *
     * @param string $filename
     *
     * @return Program
     */
    public static function fromFile(string $filename): self
    {
        $data = explode(',', file_get_contents($filename));

        return new self($data);
    }

    /**
     * Execute the program
     *
     * @return Program  The executed program
     */
    public function execute(): self
    {
        $instructions = array_chunk($this->data, 4);

        foreach ($instructions as $instruction) {
            try {
                InstructionFactory::fromArray($this, $instruction)->execute();
            } catch (RuntimeException $runtimeException) {
                break;
            }
        }

        return $this;
    }
}
