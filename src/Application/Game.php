<?php

declare(strict_types = 1);

namespace DanielM\Domino\Application;

use DanielM\Domino\Domain\Board;
use DanielM\Domino\Domain\Events\GameFinished;
use DanielM\Domino\Domain\Events\GameStarted;
use DanielM\Domino\Domain\Events\MovePlayed;
use DanielM\Domino\Domain\ValueObject\PieceCollection;
use DanielM\Domino\Domain\ValueObject\PlayersSet;
use DanielM\Domino\Infrastructure\EventPublisher;

class Game
{
    /** @var PlayersSet */
    private $players;

    /** @var Board */
    private $board;

    /** @var PieceCollection */
    private $stock;

    /** @var EventPublisher */
    private $eventPublisher;

    /** @var Player */
    private $winner;
    
    public function __construct(
        PlayersSet $players,
        Board $board, 
        PieceCollection $stock,
        EventPublisher $eventPublisher
    )
    {
        $this->players = $players;
        $this->board = $board;
        $this->stock = $stock;
        $this->eventPublisher = $eventPublisher;
    }

    public function run()
    {
        $this->preparePlayers();

        $startingPiece = $this->stock->random();
        $this->board->start($startingPiece);

        $this->eventPublisher->publish(new GameStarted($startingPiece));

        do {
            $currentPlayer = $this->players->next();
            $played = $currentPlayer->play($this->board->head()) ?? $currentPlayer->play($this->board->tail());

            if ($played) {
                $connectingPiece = $this->board->place($played);
                $this->eventPublisher->publish(new MovePlayed(
                    $currentPlayer, 
                    $played, 
                    $connectingPiece, 
                    $this->board
                ));
            } else {
                $currentPlayer->grab($this->stock->random());
            }

            if (false === $currentPlayer->hasPieces()) {
                // we have a winner
                $this->winner = $currentPlayer;
            }
        } while (! $this->isGameOver());

        $this->eventPublisher->publish(new GameFinished($this->winner));
    }

    private function isGameOver(): bool
    {
        return $this->stock->isEmpty() || !is_null($this->winner);
    }

    private function preparePlayers()
    {
        for ($i = 0; $i < $this->players->count(); $i++) {

            /** @var Player */
            $player = $this->players->next();

            for($j = 0; $j < 7; $j++) {
                $player->grab($this->stock->random());
            }
        }
    }
}
