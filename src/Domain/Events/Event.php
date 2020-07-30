<?php

declare(strict_types = 1);

namespace DanielM\Domino\Domain\Events;

interface Event
{
    public function getPayload(): array;
}
