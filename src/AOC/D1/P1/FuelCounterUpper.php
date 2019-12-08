<?php

namespace AOC\D1\P1;

/**
 * Class FuelCounterUpper
 *
 * @package AOC\D1\P1
 */
class FuelCounterUpper
{
    /** @var array */
    private $modules = [];

    /**
     * FuelCounterUpper constructor.
     *
     * @param array $modules
     */
    public function __construct(array $modules)
    {
        $this->modules = $modules;
    }

    /**
     * @param string $filename
     *
     * @return FuelCounterUpper
     */
    public static function fromFile(string $filename): self
    {
        $modules = [];

        foreach (file($filename, FILE_IGNORE_NEW_LINES) as $mass) {
            $modules[] = new Module((int) $mass);
        }

        return new self($modules);
    }

    /**
     * @return int
     */
    public function getTotalFuelRequired(): int
    {
        return array_sum(
            array_map(
                function (Module $module) {
                    return $module->getFuelRequired();
                },
                $this->modules
            )
        );
    }
}
