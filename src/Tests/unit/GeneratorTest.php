<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\Generator;
use DanielM\Domino\Domain\Piece;
use DanielM\Domino\Domain\ValueObject\PieceValue;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase 
{
    private $pieceCollection;

    public function setUp()
    {
        $this->pieceCollection = Generator::generateDominoPiecesCollection();
    }

    public function testCollectionHas28Pieces()
    {
        $this->assertCount(28, $this->pieceCollection);
    }

    /**
     * @dataProvider provider
     */
    public function testItCanGenerateACompleteDominoSet(?int $value1, ?int $value2)
    {
        $piece = new Piece(
            new PieceValue($value1),
            new PieceValue($value2)
        );

        $this->assertTrue($this->pieceCollection->hasPiece($piece));
    }

    public function provider()
    {
        return [
            [null, null], [null, 1], [null, 2], [null, 3], [null, 4], [null, 5], [null, 6],
            [1, 1], [1, 2], [1, 3], [1, 4], [1, 5], [1, 6], [2, 2],
            [2, 3], [2, 4], [2, 5], [2, 6], [3, 3], [3, 4], [3, 5],
            [3, 6], [4, 4], [4, 5], [4, 6], [5, 5], [5, 6], [6, 6],
        ];
    }
}
