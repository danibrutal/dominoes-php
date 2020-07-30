<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain\Events;

use DanielM\Domino\Domain\Board;
use DanielM\Domino\Domain\Piece;
use DanielM\Domino\Domain\Player;

class MovePlayed implements Event
{
    private $player;
    private $playedPiece;
    private $connectingPiece;
    private $board;
    
    public function __construct(
        Player $player,
        Piece $playedPiece,
        Piece $connectingPiece,
        Board $board
    ) {
        $this->player = $player;
        $this->playedPiece = $playedPiece;
        $this->connectingPiece = $connectingPiece;
        $this->board = $board;
    }

    public function getPayload(): array
    {
        return [
            'player' => $this->player,
            'playedPiece' => $this->playedPiece,
            'connectingPiece' => $this->connectingPiece,
            'board' => $this->board
        ];
    }
}
