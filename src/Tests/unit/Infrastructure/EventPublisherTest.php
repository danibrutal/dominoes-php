<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\Events\GameStarted;
use DanielM\Domino\Domain\Piece;
use DanielM\Domino\Infrastructure\EventPublisher;
use DanielM\Domino\Infrastructure\EventSubscriber\GameStartedSubscriber;
use PHPUnit\Framework\TestCase;

class EventPublisherTest extends TestCase 
{
    public function testWeCanAddGameStartedEventListener()
    {
        $subscriber = $this->getMockBuilder(GameStartedSubscriber::class)
            ->setMethods(['onEvent'])
            ->getMock();

        $publisher = new EventPublisher($subscriber);

        $piece = $this->getMockBuilder(Piece::class)
            ->disableOriginalConstructor()
            ->getMock();

        $event = new GameStarted($piece);

        $subscriber->expects($this->once())
            ->method('onEvent')
            ->with($this->equalTo($event));

        $publisher->publish($event);
    }
}
