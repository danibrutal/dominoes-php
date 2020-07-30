<?php

declare(strict_types = 1);

namespace DanielM\Domino\Infrastructure\EventSubscriber;

use DanielM\Domino\Domain\Events\Event;
use DanielM\Domino\Domain\Events\GameFinished;
use DanielM\Domino\Infrastructure\EventSubscriber\EventSubscriber;

class GameFinishedSubscriber implements EventSubscriber
{
    public function listensTo(Event $event): bool
    {
        return get_class($event) === GameFinished::class;
    }

    public function onEvent(Event $gameFinishedEvent)
    {
        $winner = $gameFinishedEvent->getPayload()['winner'];

        print is_null($winner) 
            ? "Game ended on a draw!\n" 
            : "Player {$winner} has won!\n";
    }
}
