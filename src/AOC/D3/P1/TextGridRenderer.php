<?php

namespace AOC\D3\P1;

/**
 * Class GridRenderer
 *
 * @package AOC\D3\P1
 */
class TextGridRenderer implements GridRendererInterface
{
    /**
     * @param Grid $grid
     *
     * @return string
     */
    public function render(Grid $grid): string
    {
        $output = '';

        $previousDirection = null;
        foreach ($grid->getRows() as $row) {
            foreach ($row->getCells() as $cell) {
                /** @var Visit[] $visits */
                $visits = $cell->getParameter('visits', []);
                $char = ' ';
                $visitCount = count($visits);
                switch (true) {
                    case $visitCount >= 1 && $visits[0]->getDirection() === 'start':
                        $char = 'o';
                        break;

                    case $visitCount === 1:
                        $char = $visits[0]->getSnake()->getId();
                        break;

                    case $visitCount > 1:
                        $char = 'X';
                        break;
                }
                $output .= '[ ' . $char . ' ]';
            }
            $output .= "\n";
        }

        return $output;
    }
}
