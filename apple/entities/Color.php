<?php

namespace apple\entities;

class Color
{
    const RED = 'red';
    const GREEN = 'green';
    const YELLOW = 'yellow';

    private $value;

    private $colors = [
        self::RED,
        self::GREEN,
        self::YELLOW,
    ];

    /**
     * Color constructor.
     * @param string|null $color
     */
    public function __construct(string $color = null)
    {
        $this->value = $color ?? array_rand($this->colors);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getList()
    {
        return $this->colors;
    }
}
