<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
* Test cases for class Game.
*/

class GameTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use arguments.
     */
    public function testCreateGame()
    {   
        $deck = new Deck();
        $game = new Game(1, 1, $deck);
        $this->assertInstanceOf("\App\Card\Game", $game);
    }

    /**
     * Verify that a player object is returned when getPlayer() is called.
     */
    public function testGetPlayer()
    {
        $deck = new Deck();
        $game = new Game(1, 1, $deck);

        $this->assertIsObject($game->getPlayer(0));
    }

    /**
     * Verify that an array of players is returned from getPlayers() function. 
     */
    public function testGetPlayers()
    {
        $deck = new Deck();
        $game = new Game(1, 1, $deck);

        $this->assertIsArray($game->getPlayers());
    }

}
