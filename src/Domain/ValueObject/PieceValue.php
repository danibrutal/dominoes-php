<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain\ValueObject;

class PieceValue
{
    /** @var int */
    private $value;

    public function __construct(?int $value)
    {
        if (is_int($value)) {
            if ($value < 1 || $value > 6) {
                throw new \InvalidArgumentException("Value should be null, or int between 1 and 6");
            }
        }
        $this->value = $value;
    }

    public function get(): ?int
    {
        return $this->value;
    }

    public function __toString()
    {
        return is_int($this->value) 
        ? (string) $this->value
        : '0';
    }
}
