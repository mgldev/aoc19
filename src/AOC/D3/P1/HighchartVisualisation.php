<?php

namespace AOC\D3\P1;

use Twig\Environment;

/**
 * Class HighchartVisualisation
 *
 * @package AOC\D3\P1
 */
class HighchartVisualisation
{
    /** @var Environment */
    private $twig;

    /**
     * HighchartVisualisation constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Grid $grid
     *
     * @return string
     */
    public function generate(Grid $grid): string
    {
        $highchartConfig = $this->buildHighchartConfig($grid);

        return $this->twig->render('visualisation.html.twig', ['config' => $highchartConfig]);
    }

    /**
     * Generate a Highchart config object for the given grid
     *
     * @param Grid $grid
     *
     * @return array
     */
    protected function buildHighchartConfig(Grid $grid): array
    {
        $wireSeries = [
            'name' => 'Crossed wires',
            'data' => []
        ];

        foreach ($grid->getRows() as $row) {
            /** @var Cell $cell */
            foreach ($row as $cell) {
                $gridReference = $cell->getGridReference();
                $point = array_merge(
                    [
                        'x' => $gridReference->getX(),
                        'y' => $gridReference->getY(),
                    ],
                    $this->getPointAttributes($cell)
                );
                $wireSeries['data'][] = $point;
            }
        }

        return [
            'chart' => [
                'renderTo' => 'container',
                'zoomType' => 'xy',
                'type' => 'bubble'
            ],
            'title' => [
                'text' => 'Advent of Code - Day 3 Part 1'
            ],
            'tooltip' => [
                'enabled' => false
            ],
            'plotOptions' => [
                'bubble' => [
                    'minSize' => 1,
                    'maxSize' => 10
                ],
                'series' => [
                    'turboThreshold' => 0,
                    'marker' => [
                        'enabledThreshold' => 5,
                        'radius' => 0.2
                    ],
                ],
            ],
            'xAxis' => [
                'gridLineWidth' => 0,
                'minorGridLineWidth' => 0
            ],
            'yAxis' => [
                'tickInterval' => 500,
                'gridLineWidth' => 0,
                'minorGridLineWidth' => 0
            ],
            'series' => [$wireSeries]
        ];
    }

    /**
     * @param Cell $cell
     *
     * @return array
     */
    private function getPointAttributes(Cell $cell): array
    {
        $centerGridReference = new GridReference(0, 0);
        $color = null;
        $radius = 1;

        switch (true) {
            case $cell->getGridReference()->equals($centerGridReference):
                $color = '#ccf0c3';
                $radius = 10;
                break;

            case $cell->hasIntersections():
                $color = '#f5587b';
                $radius = 10;
                break;

            case count($cell->getUniqueWires()) === 1:
                $color = $cell->getWire(0)->getColour();
                break;
        }

        return [
            'z' => $radius,
            'color' => $color
        ];
    }
}
