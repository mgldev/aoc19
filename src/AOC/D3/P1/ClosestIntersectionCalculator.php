<?php

namespace AOC\D3\P1;

/**
 * Class ClosestIntersectionCalculator
 *
 * @package AOC\D3\P1
 */
class ClosestIntersectionCalculator
{
    /** @var GridReference */
    private $centerGridReference;

    /**
     * ClosestIntersectionCalculator constructor.
     */
    public function __construct()
    {
        $this->centerGridReference = new GridReference(0, 0);
    }

    /**
     * @param Grid $grid
     *
     * @return int
     */
    public function calculate(Grid $grid): int
    {
        $intersections = [];

        foreach ($grid->getRows() as $row) {
            foreach ($row as $cell) {
                if ($cell->hasIntersections() && !$cell->getGridReference()->equals($this->centerGridReference)) {
                    $intersections[] = $cell->getGridReference();
                }
            }
        }

        $calculator = $this;

        return min(
            array_map(
                function (GridReference $gridReference) use ($calculator) {
                    return $calculator->distanceToCenter($gridReference);
                },
                $intersections
            )
        );
    }

    /**
     * @param GridReference $gridReference
     *
     * @return int
     */
    private function distanceToCenter(GridReference $gridReference): int
    {
        return $this->calculateManhattanDistance($this->centerGridReference, $gridReference);
    }

    /**
     * @param GridReference $a
     * @param GridReference $b
     *
     * @return int
     */
    private function calculateManhattanDistance(GridReference $a, GridReference $b): int
    {
        return abs($a->getY() - $b->getY()) + abs($a->getX() - $b->getX());
    }
}