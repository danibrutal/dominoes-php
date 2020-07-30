<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\Events\GameFinished;
use DanielM\Domino\Domain\Player;
use DanielM\Domino\Domain\ValueObject\PlayerName;
use DanielM\Domino\Infrastructure\EventSubscriber\GameFinishedSubscriber;
use PHPUnit\Framework\TestCase;

class GameFinishedSubscriberTest extends TestCase 
{
    public function testListensToTheRightEvent()
    {
        $subscriber = new GameFinishedSubscriber;

        $winner = new Player(new PlayerName('Alice'));

        $this->assertTrue($subscriber->listensTo(new GameFinished($winner)));
    }

    public function testItPrintsOutGameFinishedMessageOnEventWhenThereIsAWinner()
    {
        $subscriber = new GameFinishedSubscriber;

        $winner = new Player(new PlayerName('Alice'));
        $event = new GameFinished($winner);

        $this->expectOutputString("Player Alice has won!\n");
        
        $subscriber->onEvent($event);
    }

    public function testItPrintsOutGameFinishedMessageOnEventWhenThereIsADraw()
    {
        $subscriber = new GameFinishedSubscriber;
        $event = new GameFinished(null);

        $this->expectOutputString("Game ended on a draw!\n");
        
        $subscriber->onEvent($event);
    }
}
