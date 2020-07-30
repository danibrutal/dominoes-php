<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain;

use DanielM\Domino\Domain\Exception\InvalidPieceException;
use DanielM\Domino\Domain\ValueObject\PieceValue;

class Board
{
    private $sequence;

    /** @var PieceValue */
    private $head;
    
    /** @var PieceValue */
    private $tail;

    public function start(Piece $piece)
    {
        $this->sequence = [];

        $this->head = $piece->head();
        $this->tail = $piece->tail();

        $this->sequence[] = $piece;
    }

    public function place(Piece $piece): Piece
    {
        $connectingPiece = null;

        if (!$piece->has($this->head()) && !$piece->has($this->tail())) {
            throw new InvalidPieceException();
        }

        // piece is placed on starting end
        if ($this->head == $piece->head()) {
            $this->head = $piece->tail();
            $connectingPiece = $this->sequence[0];
            array_unshift(
                $this->sequence, 
                new Piece($piece->tail(), $piece->head())
            );
        } elseif ($this->head == $piece->tail()) {
            $connectingPiece = $this->sequence[0];
            $this->head = $piece->head();
            array_unshift(
                $this->sequence, 
                new Piece($piece->head(), $piece->tail())
            );
        // piece is placed on tail end
        } elseif ($this->tail == $piece->head()) {
            $this->tail = $piece->tail();
            $connectingPiece = $this->sequence[count($this->sequence) - 1];
            $this->sequence[] = new Piece($piece->head(), $piece->tail());
        } elseif ($this->tail == $piece->tail()) {
            $connectingPiece = $this->sequence[count($this->sequence) - 1];
            $this->tail = $piece->head();
            $this->sequence[] = new Piece($piece->tail(), $piece->head());
        }
        
        return $connectingPiece;
    }

    public function sequence(): array
    {
        return $this->sequence;
    }

    public function head(): PieceValue
    {
        return $this->head;
    }

    public function tail(): PieceValue
    {
        return $this->tail;
    }

    public function __toString()
    {
        $output = '';

        foreach($this->sequence as $piece) {
            $output .= "$piece ";
        }

        return rtrim($output);
    }
}
