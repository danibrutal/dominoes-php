<?php

declare(strict_types = 1);

namespace DanielM\Domino\Infrastructure;

use DanielM\Domino\Domain\Events\Event;
use DanielM\Domino\Infrastructure\EventSubscriber\EventSubscriber;

class EventPublisher
{
    private $subscribers;

    public function __construct(EventSubscriber ...$subscribers)
    {
        $this->subscribers = $subscribers;
    }

    public function publish(Event $event)
    {
        foreach($this->subscribers as $subscriber) {
            if ($subscriber->listensTo($event)) {
                $subscriber->onEvent($event);
            }
        }
    }
}
