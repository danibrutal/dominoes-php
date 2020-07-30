<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain;

use DanielM\Domino\Domain\ValueObject\PieceValue;

class Piece
{
    private $head;
    private $tail;

    public function __construct(PieceValue $head, PieceValue $tail)
    {
        $this->head = $head;
        $this->tail = $tail;
    }

    public function has(PieceValue $value): bool
    {
        return $this->head == $value
        || $this->tail == $value;
    }

    public function head(): PieceValue
    {
        return $this->head;
    }

    public function tail(): PieceValue
    {
        return $this->tail;
    }

    public function equalsTo(Piece $anotherPiece)
    {
        return $anotherPiece->head() == $this->head 
        && $anotherPiece->tail() == $this->tail;
    }

    public function __toString()
    {
        return "<{$this->head}:{$this->tail}>";
    }
}
