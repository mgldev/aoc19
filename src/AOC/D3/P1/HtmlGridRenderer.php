<?php

namespace AOC\D3\P1;

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
        $template = '
            <html>
                <body>
                    <table>%s</table>
                </body>
            </html>
        ';

        $previousDirection = null;
        $rows = '';
        foreach ($grid->getRows() as $row) {
            $columns = '';
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
                $style = $char !== ' ' ? ' style="background: blue; color: white; font-weight: bold;"' : '';
                $columns .= '<td' . $style .'>' . $char . '</td>';
            }
            $rows .= '<tr>' . $columns . '</tr>';
        }

        return sprintf($template, $rows);
    }
}
