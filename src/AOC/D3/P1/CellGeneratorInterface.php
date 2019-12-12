<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 12/12/19
 * Time: 08:33
 */

namespace AOC\D3\P1;

/**
 * Interface CellFactoryInterface
 *
 * @package AOC\D3\P1
 */
interface CellGeneratorInterface
{
    /**
     * @param GridReference $gridReference
     *
     * @return Cell
     */
    public function generate(GridReference $gridReference): Cell;
}
