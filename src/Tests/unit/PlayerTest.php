<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\Piece;
use DanielM\Domino\Domain\Player;
use DanielM\Domino\Domain\ValueObject\PieceValue;
use DanielM\Domino\Domain\ValueObject\PlayerName;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase 
{
    /** @var Player */
    private $player;

    public function setUp()
    {
        $this->player = new Player(new PlayerName('Alice'));
    }

    public function testPlayerStartsWithNoPieces()
    {
        $this->assertFalse($this->player->hasPieces());
    }

    public function testPlayerCanGrabPieces()
    {
        $this->player->grab(new Piece(
            new PieceValue(null),
            new PieceValue(null)
        ));

        $this->assertTrue($this->player->hasPieces());
    }

    public function testPlayerCanPlayIfItHasConnectingPieces()
    {
        $this->player->grab(new Piece(
            new PieceValue(null),
            new PieceValue(1)
        ));

        $secondPiece = new Piece(
            new PieceValue(6),
            new PieceValue(2)
        );

        $this->player->grab($secondPiece);

        $playedPiece = $this->player->play(new PieceValue(2));

        $this->assertEquals($secondPiece, $playedPiece);
    }
}
