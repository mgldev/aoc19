<?php

namespace AOC\D3\P1;

/**
 * Class Snake
 *
 * @package AOC\D3\P1
 */
class Snake
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

    /** @var Grid */
    private $grid;

    /** @var Cell */
    private $previousCell;

    /**
     * Snake constructor.
     *
     * @param int $id
     * @param Grid $grid
     * @param GridReference $startingGridReference
     */
    public function __construct(int $id, Grid $grid, GridReference $startingGridReference)
    {
        $this->id = $id;
        $this->grid = $grid;
        $this->visit($startingGridReference, self::START);
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

            $this->visit(new GridReference($x, $y), $direction);
        }

        return $this;
    }

    /**
     * @param int $count
     *
     * @return Snake
     */
    public function up(int $count): self
    {
        return $this->move(self::DIRECTION_UP, $count);
    }

    /**
     * @param int $count
     *
     * @return Snake
     */
    public function right(int $count): self
    {
        return $this->move(self::DIRECTION_RIGHT, $count);

    }

    /**
     * @param int $count
     *
     * @return Snake
     */
    public function down(int $count): self
    {
        return $this->move(self::DIRECTION_DOWN, $count);

    }

    /**
     * @param int $count
     *
     * @return Snake
     */
    public function left(int $count): self
    {
        return $this->move(self::DIRECTION_LEFT, $count);
    }

    /**
     * @param GridReference $gridReference
     * @param string $direction
     *
     * @return void
     */
    private function visit(GridReference $gridReference, string $direction)
    {
        $cell = $this->grid->getCell($gridReference);
        $visits = $cell->getParameter('visits');
        $visits[] = new Visit($direction, $this);
        $cell->setParameter('visits', $visits);
        $this->previousCell = $cell;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
