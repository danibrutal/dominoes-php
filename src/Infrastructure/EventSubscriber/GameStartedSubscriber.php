<?php

declare(strict_types = 1);

namespace DanielM\Domino\Infrastructure\EventSubscriber;

use DanielM\Domino\Domain\Events\Event;
use DanielM\Domino\Domain\Events\GameStarted;
use DanielM\Domino\Infrastructure\EventSubscriber\EventSubscriber;

class GameStartedSubscriber implements EventSubscriber
{
    public function listensTo(Event $event): bool
    {
        return get_class($event) === GameStarted::class;
    }

    public function onEvent(Event $gameStartedEvent)
    {
        $piece = $gameStartedEvent->getPayload()['starting_piece'];
        
        print "Game starting with first tile: {$piece}\n";
    }
}
