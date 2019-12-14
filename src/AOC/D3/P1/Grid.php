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

    /**
     * @return array[]
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param Cell $cell
     *
     * @return $this
     */
    public function addCell(Cell $cell)
    {
        $gridReference = $cell->getGridReference();

        if (!isset($this->rows[$gridReference->getY()])) {
            $this->rows[$gridReference->getY()] = [];
        }

        $this->rows[$gridReference->getY()][$gridReference->getX()] = $cell;

        return $this;
    }

    /**
     * @param GridReference $gridReference
     *
     * @return Cell|null
     */
    public function getCell(GridReference $gridReference)
    {
        return $this->rows[$gridReference->getY()][$gridReference->getX()] ?? null;
    }
}
