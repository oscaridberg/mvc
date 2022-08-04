<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
* Test cases for class TwentyOne.
*/

class TwentyOneTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use arguments.
     */
    public function testTwentyOne()
    {   
        $deck = new Deck();
        $game = new TwentyOne(1, 1, $deck);
        $this->assertInstanceOf("\App\Card\TwentyOne", $game);
    }

    public function testCheckScore()
    {
        $deck = new Deck();
        $game = new TwentyOne(1, 1, $deck);

        $this->assertIsBool($game->checkScore(0, $deck));
    }

    public function testGetPlayerScore()
    {
        $deck = new Deck();
        $game = new TwentyOne(1, 1, $deck);

        $this->assertIsInt($game->getPlayerScore(0));
    }

    public function testDealer()
    {
        $deck = new Deck();
        $game = new TwentyOne(1, 1, $deck);

        $this->assertIsInt($game->dealer(0, $deck));
    }

    public function testDecideWinner()
    {
        $deck = new Deck();
        $game = new TwentyOne(2, 2, $deck);

        $this->assertIsString($game->decideWinner());

    }

}
