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
                <head>
                    <style type="text/css">
                        td.start {
                            background-color: #ccf0c3;
                        }
                        
                        td.wire-1 {
                            background-color: #6d3580;
                        }
                        
                        td.wire-2 {
                            background-color: #ffb480;
                        }
                        
                        td.intersection {
                            background-color: #f5587b;
                        }
                        
                        td.vacant {
                            background-color: #f2f4fb;
                        }
                    </style>
                </head>
                <body>
                    <table>%s</table>
                </body>
            </html>
        ';

        $previousDirection = null;
        $rows = '';

        foreach ($grid->getRows() as $row) {
            $columns = '';
            /** @var WireContainerCell $cell */
            foreach ($row->getCells() as $cell) {
                $wires = $cell->getWires();
                $wireCount = count($wires);
                $isStartingCell = $cell->getGridReference() === $grid->getCenterGridReference();
                switch (true) {
                    case $isStartingCell:
                        $classes[] = 'start';
                        break;

                    case $wireCount === 0:
                        $classes[] = 'vacant';

                    case $wireCount === 1:
                        $classes[] = 'wire-' . $cell->getWire(0)->getId();
                        break;

                    case $wireCount > 1:
                        $classes[] = 'wire-' . $cell->getWire(0)->getId();
                        $classes[] = 'intersection';
                        break;
                }
                $columns .= '<td class="' . implode(' ', $classes). '">.</td>';
            }
            $rows .= '<tr>' . $columns . '</tr>';
        }

        return sprintf($template, $rows);
    }
}
