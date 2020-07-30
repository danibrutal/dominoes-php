<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\ValueObject\PieceValue;
use DanielM\Domino\Domain\Piece;
use PHPUnit\Framework\TestCase;

class PieceTest extends TestCase 
{
    /**
     * @dataProvider provider
     */
    public function testICanCheckIfPieceHasValue(?int $value1, ?int $value2, ?int $search, bool $expected) 
    {
        $piece = new piece(
            new PieceValue($value1),
            new PieceValue($value2)
        );

        $this->assertEquals($piece->has(new PieceValue($search)), $expected);
    }

    public function provider()
    {
        return [
            [null, 1, 1, true],
            [null, 1, 6, false],
            [null, 6, 6, true],
            [6, 6, 6, true],
            [6, 1, null, false],
        ];
    }
}
