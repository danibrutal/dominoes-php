<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain\Events;

use DanielM\Domino\Domain\Piece;

class GameStarted implements Event
{
    private $startingPiece;
    
    public function __construct(Piece $startingPiece)
    {
        $this->startingPiece = $startingPiece;  
    }

    public function getPayload(): array
    {
        return [
            'starting_piece' => $this->startingPiece
        ];
    }
}
