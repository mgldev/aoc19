<?php

namespace AOC\D3\P1;

/**
 * Class Grid
 *
 * @package AOC\D3\P1
 */
class Grid
{
    /** @var array */
    private $rows;

    /** @var int */
    private $width;

    /** @var int */
    private $height;

    /**
     * Grid constructor.
     *
     * @param int $width
     * @param int $height
     * @param CellGeneratorInterface $cellGenerator
     */
    public function __construct(int $width, int $height, CellGeneratorInterface $cellGenerator)
    {
        for ($y = 0; $y < $height; $y++) {
            $row = [];
            for ($x = 0; $x < $width; $x++) {
                $row[$x] = $cellGenerator->generate(new GridReference($x, $y));
            }
            $this->rows[$y] = $row;
        }

        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return array[]
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param GridReference $gridReference
     *
     * @return Cell|null
     */
    public function getCell(GridReference $gridReference)
    {
        return $this->rows[$gridReference->getY()][$gridReference->getX()];
    }
}
