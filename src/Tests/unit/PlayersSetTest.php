<?php

declare(strict_types = 1);

namespace unit\Domino;

use DanielM\Domino\Domain\ValueObject\PlayerName;
use DanielM\Domino\Domain\Player;
use DanielM\Domino\Domain\ValueObject\PlayersSet;
use PHPUnit\Framework\TestCase;

class PlayersSetTest extends TestCase 
{
    public function testItRotatesPerPlayer()
    {
        $player1 = new Player(new PlayerName('Alice'));
        $player2 = new Player(new PlayerName('Bob'));
        $player3 = new Player(new PlayerName('Clark'));

        $set = new PlayersSet($player1, $player2, $player3);

        $this->assertEquals('Alice', (string) $set->next());
        $this->assertEquals('Bob', (string) $set->next());
        $this->assertEquals('Clark', (string) $set->next());
        $this->assertEquals('Alice', (string) $set->next());
        $this->assertEquals('Bob', (string) $set->next());
        $this->assertEquals('Clark', (string) $set->next());
    }
}
