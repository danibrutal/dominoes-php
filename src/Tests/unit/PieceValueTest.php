<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\ValueObject\PieceValue;
use PHPUnit\Framework\TestCase;

class PieceValueTest extends TestCase 
{
    /**
     * @dataProvider providerWithAllowedValues
     */
    public function testOnlyAllowPossibleDominoPieceValues(?int $value) 
    {
        $this->pieceValue = new PieceValue($value);
        $this->assertEquals($this->pieceValue->get(), $value);
    }

    /**
     * @dataProvider providerWithAllowedValues
     */
    public function testValuesCanBeCompared(?int $value)
    {
        $pieceValueA = new PieceValue($value);
        $pieceValueB = new PieceValue($value);

        $this->assertTrue($pieceValueA == $pieceValueB);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionIfValueIsNotAllowed() 
    {
        $this->pieceValue = new PieceValue(7);
    }

    public function providerWithAllowedValues()
    {
        return [
            [null],
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
        ];
    }
}
