<?php

namespace AOC\D3\P1;

use InvalidArgumentException;

/**
 * Ensure we have valid dimensions for a centralised grid, i.e.
 *
 * 3 = 1,1
 * x x x
 * x o x
 * x x x
 *
 * 5 = 2,2
 * x x x x x
 * x x x x x
 * x x o x x
 * x x x x x
 * x x x x x
 *
 * 7 = 3,3
 * x x x x x x x
 * x x x x x x x
 * x x x x x x x
 * x x x o x x x
 * x x x x x x x
 * x x x x x x x
 * x x x x x x x
 *
 * @param int $width
 * @param int $height
 *
 * @return bool
 */
class CentralisedGrid extends Grid
{
    /** @var GridReference */
    private $centerGridReference;

    /**
     * CentralisedGrid constructor.
     *
     * @param int $size
     * @param CellGeneratorInterface $cellGenerator
     */
    public function __construct(int $size, CellGeneratorInterface $cellGenerator)
    {
        if ($size % 2 === 0) {
            throw new InvalidArgumentException('Centralised grids must be an odd size');
        }

        parent::__construct($size, $size, $cellGenerator);
    }

    /**
     * @return GridReference
     */
    public function getCenterGridReference(): GridReference
    {
        if ($this->centerGridReference === null) {
            $totalPoints = $totalX = $totalY = 0;

            foreach ($this->getRows() as $row) {
                /** @var WireContainerCell $cell */
                foreach ($row as $cell) {
                    $totalPoints++;
                    $totalX += $cell->getGridReference()->getX();
                    $totalY += $cell->getGridReference()->getY();
                }
            }

            $x = $totalX / $totalPoints;
            $y = $totalY / $totalPoints;

            $this->centerGridReference = new GridReference($x, $y);
        }

        return $this->centerGridReference;
    }
}
