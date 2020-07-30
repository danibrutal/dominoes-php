<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain\ValueObject;

use DanielM\Domino\Domain\Player;

class PlayersSet implements \Countable
{
    /** @var array */
    private $players;

    /** @var int */
    private $position = 0;

    public function __construct(Player ...$players)
    {
        $this->players = $players;
    }

    public function count(): int
    {
        return count($this->players);
    }

    public function next(): Player
    {
        return $this->players[
            ($this->position++ % $this->count())
        ];
    }
}
