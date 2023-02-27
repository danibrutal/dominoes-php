# dominoes-php

Implementation of a Domino game in PHP in command-line 

## Dependencies
The only third party library used is phpunit to guide the development with unit tests.

Run ```composer install``` in the root directory to install phpunit (requires composer installation)

## How to run the tests?
I run ```./vendor/phpunit/phpunit/phpunit src/Tests/unit/``` in the root directory. It should show a message

like this:
```
Configuration: /var/www/domino/phpunit.xml

................................................................. 65 / 74 ( 87%)
.........                                                         74 / 74 (100%)

Time: 807 ms, Memory: 6.00 MB

OK (74 tests, 129 assertions)
```

## How to run the game?
In the root directory, run
```php app.php```

Output should be something like (in the case that a player wins):
```
Game starting with first tile: <2:6>
Alice plays <2:5> to connect to tile <2:6> on the board
Board is now: <5:2> <2:6>
Bob plays <5:5> to connect to tile <5:2> on the board
Board is now: <5:5> <5:2> <2:6>
Alice plays <5:6> to connect to tile <5:5> on the board
Board is now: <6:5> <5:5> <5:2> <2:6>
Bob plays <4:6> to connect to tile <6:5> on the board
Board is now: <4:6> <6:5> <5:5> <5:2> <2:6>
Alice plays <6:6> to connect to tile <2:6> on the board
Board is now: <4:6> <6:5> <5:5> <5:2> <2:6> <6:6>
Bob plays <3:6> to connect to tile <6:6> on the board
Board is now: <4:6> <6:5> <5:5> <5:2> <2:6> <6:6> <6:3>
Alice plays <3:3> to connect to tile <6:3> on the board
Board is now: <4:6> <6:5> <5:5> <5:2> <2:6> <6:6> <6:3> <3:3>
Bob plays <1:3> to connect to tile <3:3> on the board
Board is now: <4:6> <6:5> <5:5> <5:2> <2:6> <6:6> <6:3> <3:3> <3:1>
Alice plays <1:1> to connect to tile <3:1> on the board
Board is now: <4:6> <6:5> <5:5> <5:2> <2:6> <6:6> <6:3> <3:3> <3:1> <1:1>
Alice plays <1:5> to connect to tile <1:1> on the board
Board is now: <4:6> <6:5> <5:5> <5:2> <2:6> <6:6> <6:3> <3:3> <3:1> <1:1> <1:5>
Bob plays <3:5> to connect to tile <1:5> on the board
Board is now: <4:6> <6:5> <5:5> <5:2> <2:6> <6:6> <6:3> <3:3> <3:1> <1:1> <1:5> <5:3>
Alice plays <0:3> to connect to tile <5:3> on the board
Board is now: <4:6> <6:5> <5:5> <5:2> <2:6> <6:6> <6:3> <3:3> <3:1> <1:1> <1:5> <5:3> <3:0>
Player Alice has won!
```

