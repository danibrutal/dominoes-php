<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\Board;
use DanielM\Domino\Domain\Events\MovePlayed;
use DanielM\Domino\Domain\Piece;
use DanielM\Domino\Domain\Player;
use DanielM\Domino\Domain\ValueObject\PieceValue;
use DanielM\Domino\Domain\ValueObject\PlayerName;
use DanielM\Domino\Infrastructure\EventSubscriber\MovePlayedSubscriber;
use PHPUnit\Framework\TestCase;

class MovePlayedSubscriberTest extends TestCase 
{
    public function testListensToTheRightEvent()
    {
        $subscriber = new MovePlayedSubscriber;

        $player = $this->getMockBuilder(Player::class)
        ->disableOriginalConstructor()
        ->getMock();
        
        $played = $this->getMockBuilder(Piece::class)
        ->disableOriginalConstructor()
        ->getMock();

        $connecting = $this->getMockBuilder(Piece::class)
        ->disableOriginalConstructor()
        ->getMock();

        $board = $this->getMockBuilder(Board::class)
        ->disableOriginalConstructor()
        ->getMock();

        $event = new MovePlayed($player, $played, $connecting, $board);

        $this->assertTrue($subscriber->listensTo($event));
    }

    public function testItPrintsOutMovedPlayedMessageOnEvent()
    {
        $subscriber = new MovePlayedSubscriber;

        $startingPiece = new Piece(new PieceValue(4), new PieceValue(1));
        $board = new Board;

        $board->start($startingPiece);

        $piece = new Piece(new PieceValue(null), new PieceValue(4));

        $board->place($piece);

        $player = new Player(new PlayerName('Alice'));
        $event = new MovePlayed($player, $piece, $startingPiece, $board);

        $this->expectOutputString("Alice plays <0:4> to connect to tile <4:1> on the board\nBoard is now: <0:4> <4:1>\n");
        
        $subscriber->onEvent($event);
    }
}
