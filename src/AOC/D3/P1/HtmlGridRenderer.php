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
                        break;

                    case $wireCount === 1:
                        $classes[] = 'wire-' . $cell->getWire(0)->getId();
                        break;

                    case $wireCount > 1:
                        $classes[] = 'intersection';
                        break;
                }
                $columns .= '<td class="' . implode(' ', $classes). '">.</td>';
            }
            fwrite($file, '<tr>' . $columns . '</tr>');
        }

        fwrite($file, '                    
                    </table>
                </body>
            </html>
        ');
    }
}
