<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
* Test cases for class Player.
*/

class PlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use arguments.
     */
    public function testPlayer()
    {   
        $player = new Player(1, 1);
        $this->assertInstanceOf("\App\Card\Player", $player);

        $res = $player->getId();
        $this->assertNotEmpty($res);
    }

    /**
     * Verify that cards can be added to player hand from a deck of cards.
     */
    public function testCardHand()
    {
        $deck = new Deck();
        $player = new Player(1, 1);

        $player->addHand(1, $deck);

        $this->assertIsObject($player->getHandObject());
    }

    /**
     * Verify that an array is returned from getHand().
     */
    public function testGetHand()
    {
        $deck = new Deck();
        $player = new Player(1, 1);

        $player->addHand(1, $deck);

        $this->assertIsArray($player->getHand());
    }

}
