<?php

declare(strict_types = 1);

namespace DanielM\Domino\Infrastructure\EventSubscriber;

use DanielM\Domino\Domain\Events\Event;

interface EventSubscriber
{
    public function listensTo(Event $event): bool;

    public function onEvent(Event $event);
}
