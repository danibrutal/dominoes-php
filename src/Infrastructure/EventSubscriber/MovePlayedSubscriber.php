<?php

declare(strict_types = 1);

namespace DanielM\Domino\Infrastructure\EventSubscriber;

use DanielM\Domino\Domain\Events\Event;
use DanielM\Domino\Domain\Events\MovePlayed;
use DanielM\Domino\Infrastructure\EventSubscriber\EventSubscriber;

class MovePlayedSubscriber implements EventSubscriber
{
    public function listensTo(Event $event): bool
    {
        return get_class($event) === MovePlayed::class;
    }

    public function onEvent(Event $movePlayedEvent)
    {
        $payload = $movePlayedEvent->getPayload();

        $player = $payload['player'];
        $playedPiece = $payload['playedPiece'];
        $connectingPiece = $payload['connectingPiece'];
        $board = $payload['board'];

        print "{$player} plays {$playedPiece} to connect to tile {$connectingPiece} on the board";
        print "\nBoard is now: {$board}\n";
    }
}
