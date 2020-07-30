<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\Generator;
use DanielM\Domino\Domain\Piece;
use DanielM\Domino\Domain\ValueObject\PieceCollection;
use DanielM\Domino\Domain\ValueObject\PieceValue;
use PHPUnit\Framework\TestCase;

class PieceCollectionTest extends TestCase 
{
    /** @var PieceCollection */
    private $collection;

    public function setUp()
    {
        $this->collection = Generator::generateDominoPiecesCollection();
    }

    public function testWeCanCheckIfCollectionIsEmpty()
    {
        $this->assertTrue((new PieceCollection())->isEmpty());
    }

    public function testGetPieceRemovesFromCollection()
    {
        $originalCount = $this->collection->count();
        $piece = $this->collection->random();

        $this->assertCount($originalCount - 1, $this->collection);
    }

    public function testItCanExtractARandomPieces()
    {
       for ($i = 0; $i < 28; $i++) {
           $this->assertInstanceOf(Piece::class, $this->collection->random());
       }

       $this->assertEquals(0, $this->collection->count());
    }

    public function testItCanExtractPieceByValue()
    {
        $search = new PieceValue(6);
        $found = $this->collection->byValue($search);

        $this->assertInstanceOf(Piece::class, $found);

        $this->assertTrue($found->has($search));

        $this->assertCount(27, $this->collection);
    }
}
