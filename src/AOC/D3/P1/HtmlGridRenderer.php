<?php

namespace AOC\D3\P1;

use InvalidArgumentException;

/**
 * Class HtmlGridRenderer
 *
 * @package AOC\D3\P1
 */
class HtmlGridRenderer implements GridRendererInterface
{
    /**
     * @param Grid $grid
     * 
     * @return string
     */
    public function render(Grid $grid): string
    {
        if (!$grid instanceof CentralisedGrid) {
            throw new InvalidArgumentException('HtmlGridRenderer must be a centralised grid');
        }

        $template = '
            <html>
                <body>
                    <table>%s</table>
                </body>
            </html>
        ';

        $previousDirection = null;
        $rows = '';

        $classes = ['cell'];

        foreach ($grid->getRows() as $row) {
            $columns = '';
            /** @var WireContainerCell $cell */
            foreach ($row->getCells() as $cell) {
                $wires = $cell->getWires();
                $char = ' ';
                $wireCount = count($wires);
                $isStartingCell = $cell->getGridReference() === $grid->getCenterGridReference();
                switch (true) {
                    case $isStartingCell:
                        $classes[] = 'start';
                        break;

                    case $wireCount === 1:
                        $classes[] = 'wire-' . $cell->getWire(0)->getId();
                        break;

                    case $wireCount > 1:
                        $char = 'X';
                        break;
                }
                $style = $char !== ' ' ? ' ' : '';
                $columns .= '<td' . $style .'>' . $char . '</td>';
            }
            $rows .= '<tr>' . $columns . '</tr>';
        }

        return sprintf($template, $rows);
    }
}
