<?php

namespace AOC\D3\P1;

/**
 * Class WireContainerCellGenerator
 *
 * @package AOC\D3\P1
 */
class WireContainerCellGenerator implements CellGeneratorInterface
{
    /**
     * @param GridReference $gridReference
     *
     * @return Cell
     */
    public function generate(GridReference $gridReference): Cell
    {
        return new WireContainerCell($gridReference);
    }

}