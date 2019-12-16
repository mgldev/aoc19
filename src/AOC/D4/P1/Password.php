<?php

namespace AOC\D4\P1;

use InvalidArgumentException;

/**
 * Class Password
 *
 * @package AOC\D4\P1
 */
class Password
{
    /** @var string */
    private $password;

    /**
     * Password constructor.
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;

        if (!$this->isValid()) {
            throw new InvalidArgumentException('Invalid password');
        }
    }

    private function isValid(): bool
    {
        return $this->isAscending() && $this->hasRepeatingSequence();
    }

    /**
     * @return bool
     */
    private function isAscending(): bool
    {
        $chars = str_split($this->password);
        sort($chars, SORT_ASC);

        return implode($chars) === $this->password;
    }

    /**
     * @return bool
     */
    public function hasRepeatingSequence(): bool
    {
        return preg_match('/(\d)\1+/', $this->password) !== 0;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->password;
    }
}