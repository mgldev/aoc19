<?php

namespace AOC\D3\P1;

/**
 * Class Cell
 *
 * @package AOC\D3\P1
 */
class Cell
{
    /** @var GridReference */
    private $gridReference;

    /** @var array */
    private $parameters;

    /**
     * Cell constructor.
     * @param GridReference $gridReference
     */
    public function __construct(GridReference $gridReference)
    {
        $this->gridReference = $gridReference;
    }

    /**
     * @param string $name
     * @param $value
     *
     * @return Cell
     */
    public function setParameter(string $name, $value): self
    {
        $this->parameters[$name] = $value;

        return $this;
    }

    /**
     * @param string $name
     *
     * @param $default
     *
     * @return mixed|null
     */
    public function getParameter(string $name, $default = null)
    {
        return $this->parameters[$name] ?? $default;
    }

    /**
     * @return GridReference
     */
    public function getGridReference(): GridReference
    {
        return $this->gridReference;
    }
}
