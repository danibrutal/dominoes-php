<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\Events\GameStarted;
use DanielM\Domino\Domain\Piece;
use DanielM\Domino\Domain\ValueObject\PieceValue;
use DanielM\Domino\Infrastructure\EventSubscriber\GameStartedSubscriber;
use PHPUnit\Framework\TestCase;

class GameStartedSubscriberTest extends TestCase 
{
    public function testListensToTheRightEvent()
    {
        $subscriber = new GameStartedSubscriber;

        $piece = $this->getMockBuilder(Piece::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->assertTrue($subscriber->listensTo(new GameStarted($piece)));
    }

    public function testItPrintsOutGameStartedMessageOnEvent()
    {
        $subscriber = new GameStartedSubscriber;

        $piece = new Piece(new PieceValue(4), new PieceValue(1));
        $event = new GameStarted($piece);

        $this->expectOutputString("Game starting with first tile: <4:1>\n");
        
        $subscriber->onEvent($event);
    }
}
