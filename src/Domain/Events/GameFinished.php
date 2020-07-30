<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain\Events;

use DanielM\Domino\Domain\Player;

class GameFinished implements Event
{
    private $winner;
    
    public function __construct(?Player $winner)
    {
        $this->winner = $winner;  
    }

    public function getPayload(): array
    {
        return [
            'winner' => $this->winner
        ];
    }
}
