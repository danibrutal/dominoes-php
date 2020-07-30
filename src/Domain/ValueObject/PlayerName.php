<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain\ValueObject;

class PlayerName
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        if (! preg_match('|^[a-zA-Z0-9_]+$|', $name)) {
            throw new \InvalidArgumentException("Name should contain alphanumeric characters and not be empty");
        }

        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
