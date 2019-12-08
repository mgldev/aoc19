<?php

namespace AOC\D1\P2;

use AOC\D1\P1\Module;

/**
 * Class RecursiveFuelModule
 *
 * @package AOC\D1\P2
 */
class RecursiveFuelModule extends Module
{
    /**
     * @return int
     */
    public function getFuelRequired(): int
    {
        $total = $fuelRequired = parent::getFuelRequired();

        while ($fuelRequired >= 0) {
            $total += ($fuelRequired = (new Module($fuelRequired))->getFuelRequired()) > 0 ? $fuelRequired : 0;
        }

        return $total;
    }
}
