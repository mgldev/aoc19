<?php

namespace AOC\D3\P1;

/**
 * Class Row
 *
 * @package AOC\D3\P1
 */
class Row
{
    /** @var Cell[] */
    private $cells = [];

    /**
     * @param int $columnIndex
     * @param Cell $cell
     *
     * @return Row
     */
    public function setCell(int $columnIndex, Cell $cell): self
    {
        $this->cells[$columnIndex] = $cell;

        return $this;
    }

    /**
     * @param int $columnIndex
     *
     * @return Cell
     */
    public function getCell(int $columnIndex): Cell
    {
        return $this->cells[$columnIndex];
    }

    /**
     * @return Cell[]
     */
    public function getCells(): array
    {
        return $this->cells;
    }
}
