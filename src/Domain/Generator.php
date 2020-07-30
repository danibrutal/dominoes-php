<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain;

use DanielM\Domino\Domain\ValueObject\PieceCollection;
use DanielM\Domino\Domain\ValueObject\PieceValue;

class Generator
{
    public static function generateDominoPiecesCollection(): PieceCollection
    {
        $possibleValues = [null, 1, 2, 3, 4, 5, 6];
        $pieces = [];

        for ($i = 0; $i < count($possibleValues); $i++) {
            for ($j = $i; $j < count($possibleValues); $j++) {
                $pieces[] = new Piece(
                    new PieceValue($possibleValues[$i]),
                    new PieceValue($possibleValues[$j])
                );
            }
        }

        return new PieceCollection(...$pieces);
    }
}
