<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain\ValueObject;

use DanielM\Domino\Domain\Piece;

class PieceCollection implements \Countable
{
    /** @var array */
    private $collection;

    public function __construct(Piece ...$pieces)
    {
        $this->collection = $pieces;
    }

    public function add(Piece $piece)
    {
        $this->collection[] = $piece;
    }

    public function count(): int
    {
        return count($this->collection);
    }

    public function random(): Piece
    {
        $index = rand(0, $this->count() - 1);
        $piece =  $this->collection[$index];
        \array_splice($this->collection, $index, 1);
        
        return $piece;
    }

    public function shuffle()
    {
        \shuffle($this->collection);

        return $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->collection);
    }

    public function hasPiece(Piece $toFind): bool
    {
        foreach($this->collection as $piece) {
            if ($toFind->equalsTo($piece)) {
                return true;
            }
        }

        return false;
    }

    public function byValue(PieceValue $value): ?Piece
    {
        foreach($this->collection as $index => $piece) {
            if ($piece->has($value)) {
                \array_splice($this->collection, $index, 1);
                return $piece;
            }
        }

        return null;
    }
}
