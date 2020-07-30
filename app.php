<?php

declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';

use DanielM\Domino\Application\Game;
use DanielM\Domino\Domain\Board;
use DanielM\Domino\Domain\Events\GameFinished;
use DanielM\Domino\Domain\Generator;
use DanielM\Domino\Domain\Player;
use DanielM\Domino\Domain\ValueObject\PlayerName;
use DanielM\Domino\Domain\ValueObject\PlayersSet;
use DanielM\Domino\Infrastructure\EventPublisher;
use DanielM\Domino\Infrastructure\EventSubscriber\GameFinishedSubscriber;
use DanielM\Domino\Infrastructure\EventSubscriber\GameStartedSubscriber;
use DanielM\Domino\Infrastructure\EventSubscriber\MovePlayedSubscriber;

// Players
$Alice = new Player(new PlayerName('Alice'));
$Bob = new Player(new PlayerName('Bob'));

// Some event subscribers
$gameStartedSubscriber = new GameStartedSubscriber;
$gameFinishedSubscriber = new GameFinishedSubscriber;
$movePlayedSubscriber = new MovePlayedSubscriber;

// Create the game
$game = new Game(
    new PlayersSet($Alice, $Bob),
    new Board,
    Generator::generateDominoPiecesCollection()->shuffle(),
    new EventPublisher($gameStartedSubscriber, $gameFinishedSubscriber, $movePlayedSubscriber)
);

// Run :)
$game->run();
