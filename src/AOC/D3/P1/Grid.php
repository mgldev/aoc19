<?php

namespace AOC\D3\P1;

/**
 * Class Grid
 *
 * @package AOC\D3\P1
 */
class Grid
{
    /** @var Row[] */
    private $rows;

    /** @var int */
    private $width;

    /** @var int */
    private $height;

    /**
     * Grid constructor.
     *
     * @param int $width
     * @param int $height
     * @param CellGeneratorInterface $cellGenerator
     */
    public function __construct(int $width, int $height, CellGeneratorInterface $cellGenerator)
    {
        for ($y = 0; $y < $height; $y++) {
            $row = new Row();
            for ($x = 0; $x < $width; $x++) {
                $row->setCell($x, $cellGenerator->generate(new GridReference($x, $y)));
            }
            $this->rows[$y] = $row;
        }

        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return Row[]
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param GridReference $gridReference
     *
     * @return Cell|null
     */
    public function getCell(GridReference $gridReference)
    {
        return $this->rows[$gridReference->getY()]->getCell($gridReference->getX()) ?? null;
    }

    /**
     * @param GridReference $gridReference
     * @param string $name
     * @param $value
     *
     * @return Grid
     */
    public function setParameter(GridReference $gridReference, string $name, $value): self
    {
        $cell = $this->getCell($gridReference);
        $cell->setParameter($name, $value);

        return $this;
    }
}
