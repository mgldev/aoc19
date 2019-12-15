<?php

namespace AOC\D3\P1;

/**
 * Class Wire
 *
 * @package AOC\D3\P1
 */
class Wire
{
    /** @var string */
    const START = 'start';

    /** @var string */
    const DIRECTION_UP = 'up';

    /** @var string */
    const DIRECTION_RIGHT = 'right';

    /** @var string */
    const DIRECTION_DOWN = 'down';

    /** @var string */
    const DIRECTION_LEFT = 'left';

    /** @var string */
    private $id;

    /** @var string */
    private $colour;

    /** @var Grid */
    private $grid;

    /** @var Cell */
    private $previousCell;

    /** @var int */
    private $stepsTravelled = 0;

    /**
     * Wire constructor.
     *
     * @param int $id
     * @param string|null $colour
     * @param Grid $grid
     */
    public function __construct(int $id, Grid $grid, string $colour = null)
    {
        $this->id = $id;
        $this->colour = $colour;
        $this->grid = $grid;
        $this->visit(new GridReference(0, 0));
    }

    /**
     * @return string|null
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * @param string $direction
     * @param int $count
     *
     * @return $this
     */
    public function move(string $direction, int $count)
    {
        for ($i = 0; $i < $count; $i++) {
            $previousGridReference = $this->previousCell->getGridReference();
            $isMovingVertically = in_array($direction, [self::DIRECTION_UP, self::DIRECTION_DOWN]);
            $x = $previousGridReference->getX();
            $y = $previousGridReference->getY();

            if ($isMovingVertically) {
                $y = $direction === self::DIRECTION_UP ? $y - 1 : $y + 1;
            } else {
                $x = $direction === self::DIRECTION_RIGHT ? $x + 1 : $x - 1;
            }

            $this->stepsTravelled++;
            $this->visit(new GridReference($x, $y));
        }

        return $this;
    }

    /**
     * @param string $instructions
     */
    public function navigateFromString(string $instructions)
    {
        $this->navigate(explode(',', $instructions));
    }

    /**
     * @param array $instructions
     */
    public function navigate(array $instructions)
    {
        $directionMap = [
            'U' => self::DIRECTION_UP,
            'R' => self::DIRECTION_RIGHT,
            'D' => self::DIRECTION_DOWN,
            'L' => self::DIRECTION_LEFT,
        ];

        foreach ($instructions as $instruction) {
            $directionCode = substr($instruction, 0, 1);
            $distance = substr($instruction, 1);
            $direction = $directionMap[$directionCode];
            $this->move($direction, $distance);
        }
    }

    /**
     * @param GridReference $gridReference
     *
     * @return void
     */
    private function visit(GridReference $gridReference)
    {
        if (!$cell = $this->grid->getCell($gridReference)) {
            $this->grid->addCell($cell = new Cell($gridReference));
        }

        $cell->addVisit(new Visit($this->stepsTravelled, $this));
        $this->previousCell = $cell;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getId();
    }
}
