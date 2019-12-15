<?php

namespace AOC\D3\P2;

use AOC\D3\P1\Cell;
use AOC\D3\P1\Grid;
use AOC\D3\P1\GridReference;
use AOC\D3\P1\Visit;

/**
 * Class FewestCombinedStepsCalculator
 *
 * @package AOC\D3\P2
 */
class FewestCombinedStepsCalculator
{
    /**
     * @param Grid $grid
     *
     * @return int
     */
    public function calculate(Grid $grid): int
    {
        /** @var Cell[] $intersectingCells */
        $intersectingCells = [];

        foreach ($grid->getRows() as $row) {
            foreach ($row as $cell) {
                if ($cell->hasIntersections() && !$cell->getGridReference()->equals(new GridReference(0, 0))) {
                    $intersectingCells[] = $cell;
                }
            }
        }

        $totals = [];

        foreach ($intersectingCells as $intersectingCell) {
            $combinedStepsTravelled = 0;
            /** @var Visit[] $visits */
            foreach ($intersectingCell->getVisits() as $visits) {
                $combinedStepsTravelled += $visits[0]->getStepsTravelled();
            }
            $totals[] = $combinedStepsTravelled;
        }

        return min($totals);
    }
}
