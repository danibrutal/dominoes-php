<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\ValueObject\PlayerName;
use PHPUnit\Framework\TestCase;

class PlayerNameTest extends TestCase 
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDoesNotAcceptEmptyStrings()
    {
        new PlayerName('');
    }

    public function testItAcceptsAlphanumericCharacters()
    {
        $name = new PlayerName('Alice_3');
        $this->assertEquals('Alice_3', (string) $name);
    }
}
