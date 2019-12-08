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
     * @param string $moduleClass
     *
     * @return $this
     */
    public static function fromFile(string $filename, string $moduleClass = Module::class): self
    {
        $modules = [];

        foreach (file($filename, FILE_IGNORE_NEW_LINES) as $mass) {
            $modules[] = new $moduleClass((int) $mass);
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
