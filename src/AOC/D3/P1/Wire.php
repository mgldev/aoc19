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

    /** @var Grid */
    private $grid;

    /** @var Cell */
    private $previousCell;

    /**
     * Wire constructor.
     *
     * @param int $id
     * @param CentralisedGrid $grid
     */
    public function __construct(int $id, CentralisedGrid $grid)
    {
        $this->id = $id;
        $this->grid = $grid;
        $this->visit($grid->getCenterGridReference(), self::START);
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
     * @return Wire
     */
    public function up(int $count): self
    {
        return $this->move(self::DIRECTION_UP, $count);
    }

    /**
     * @param int $count
     *
     * @return Wire
     */
    public function right(int $count): self
    {
        return $this->move(self::DIRECTION_RIGHT, $count);

    }

    /**
     * @param int $count
     *
     * @return Wire
     */
    public function down(int $count): self
    {
        return $this->move(self::DIRECTION_DOWN, $count);

    }

    /**
     * @param int $count
     *
     * @return Wire
     */
    public function left(int $count): self
    {
        return $this->move(self::DIRECTION_LEFT, $count);
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
     * @param string $direction
     *
     * @return void
     */
    private function visit(GridReference $gridReference, string $direction)
    {
        $cell = $this->getCell($gridReference);
        $cell->addWire($this);
        $this->previousCell = $cell;
    }

    /**
     * @param GridReference $gridReference
     *
     * @return WireContainerCell
     */
    private function getCell(GridReference $gridReference): WireContainerCell
    {
        /** @var WireContainerCell $cell */
        $cell = $this->grid->getCell($gridReference);

        return $cell;
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
