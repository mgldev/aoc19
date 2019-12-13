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
     * @param array $options
     *
     * @return string
     */
    public function render(Grid $grid, array $options = []): string
    {
        if (!$grid instanceof CentralisedGrid) {
            throw new InvalidArgumentException('HtmlGridRenderer must be a centralised grid');
        }

        $filename = $options['filename'];

        $file = fopen($filename, 'w');

        fwrite($file,'
            <html>
                <head>
                    <style type="text/css">
                    
                        td {
                            padding: 4px;
                        }
                        table, tr, td {
                            border: 1px solid #e5e5e5;
                        }
                        
                        td.start {
                            background-color: #ccf0c3;
                        }
                        
                        td.wire-1 {
                            background-color: #6d3580;
                        }
                        
                        td.wire-2 {
                            background-color: #ffb480;
                        }
                        
                        td.overlapping {
                            background; opacity: 0.6;
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
                    <table>
        ');

        $previousDirection = null;

        foreach ($grid->getRows() as $row) {
            $columns = '';
            /** @var WireContainerCell $cell */
            foreach ($row->getCells() as $cell) {
                $isStartingCell = $cell->getGridReference()->equals($grid->getCenterGridReference());
                $classes = [];

                switch (true) {
                    case $isStartingCell:
                        $classes[] = 'start';
                        break;

                    case !$cell->hasWires():
                        $classes[] = 'vacant';
                        break;

                    case count($cell->getUniqueWires()) === 1:
                        $classes[] = 'wire-' . $cell->getWire(0)->getId();
                        if ($cell->hasOverlaps()) {
                            $classes[] = 'overlapping';
                        }
                        break;

                    case $cell->hasIntersections():
                        $classes[] = 'intersection';
                        break;
                }
                $columns .= '<td class="' . implode(' ', $classes). '"></td>';
            }
            fwrite($file, '<tr>' . $columns . '</tr>');
        }

        fwrite($file, '                    
                    </table>
                </body>
            </html>
        ');

        return $filename;
    }
}
