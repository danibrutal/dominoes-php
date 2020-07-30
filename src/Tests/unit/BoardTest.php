<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\Board;
use DanielM\Domino\Domain\Piece;
use DanielM\Domino\Domain\ValueObject\PieceValue;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase 
{
    /** @var Board */
    private $board;

    public function setUp()
    {
        $this->board = new Board();
    }

    public function testBoardCanBeStarted()
    {
        $startingPiece = new Piece(
            new PieceValue(null),
            new PieceValue(6)
        );

        $this->board->start($startingPiece);

        $this->assertEquals($startingPiece->head(), $this->board->head());
        $this->assertEquals($startingPiece->tail(), $this->board->tail());
    }

    /**
     * @expectedException \DanielM\Domino\Domain\Exception\InvalidPieceException
     */
    public function testWeCannotPlacePiecesInTheBoardIfValuesDontMatchOnRespectiveEnds()
    {
        $startingPiece = new Piece(
            new PieceValue(null),
            new PieceValue(6)
        );

        $this->board->start($startingPiece);

        $newPiece = new Piece(
            new PieceValue(1),
            new PieceValue(3)
        );

        $this->board->place($newPiece);
    }

    /**
     * @dataProvider provider
     */
    public function testWeCanPlacePiecesInTheBoardIfItValuesMatchOnRespectiveEnds(
        ?int $startingPieceHead,
        ?int $startingPieceTail,
        ?int $connectingPieceHead,
        ?int $connectingPieceTail,
        ?int $expectedNewBoardHead,
        ?int $expectedNewBoardTail
    )
    {
        $startingPiece = new Piece(
            new PieceValue($startingPieceHead),
            new PieceValue($startingPieceTail)
        );

        $this->board->start($startingPiece);

        $newPiece = new Piece(
            new PieceValue($connectingPieceHead),
            new PieceValue($connectingPieceTail)
        );

        $conntectedWith = $this->board->place($newPiece);
        
        $this->assertEquals($this->board->head(), new PieceValue($expectedNewBoardHead));
        $this->assertEquals($this->board->tail(), new PieceValue($expectedNewBoardTail));

        $this->assertEquals($conntectedWith, $startingPiece);
    }

    public function testWeCanGetTheRightSequenceFromTheBoard()
    {
        $expectedSequence = [[3, 1], [1, null], [null, 6], [6, 1], [1, null]];
        $startingPiece = new Piece(
            new PieceValue(null),
            new PieceValue(6)
        );

        $this->board->start($startingPiece);
        $this->board->place(new Piece(new PieceValue(null), new PieceValue(1)));
        $this->board->place(new Piece(new PieceValue(1), new PieceValue(3)));
        $this->board->place(new Piece(new PieceValue(6), new PieceValue(1)));
        $this->board->place(new Piece(new PieceValue(1), new PieceValue(null)));

        $this->assertEquals($this->board->head(), new PieceValue(3));
        $this->assertEquals($this->board->tail(), new PieceValue(null));

        foreach($this->board->sequence() as $i => $piece) {
            $this->assertEquals($piece->head()->get(), $expectedSequence[$i][0]);
            $this->assertEquals($piece->tail()->get(), $expectedSequence[$i][1]);
        }
    }

    public function provider()
    {
        return [
            [3, 1, 3, 6, 6, 1],
            [3, 1, 5, 3, 5, 1],
            [null, 1, 1, 6, null, 6],
            [null, 1, 4, 1, null, 4],
        ];
    }
}
