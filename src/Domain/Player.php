<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain;

use DanielM\Domino\Domain\ValueObject\PieceCollection;
use DanielM\Domino\Domain\ValueObject\PieceValue;
use DanielM\Domino\Domain\ValueObject\PlayerName;

class Player
{
    private $name;
    private $pieces;
    
    public function __construct(PlayerName $name)
    {
        $this->name = $name;
        $this->pieces = new PieceCollection();
    }

    public function hasPieces() : bool
    {
        return (bool) count($this->pieces);
    }

    public function play(PieceValue $value): ?Piece
    {
        return $this->pieces->byValue($value);
    }

    public function __toString(): string
    {
        return (string) $this->name;
    }

    public function grab(Piece $piece)
    {
        $this->pieces->add($piece);
    }
}
