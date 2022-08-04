<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
* Test cases for class Deck2Jokers.
*/

class Deck2JokersTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDeck2Jokers()
    {
        $deck = new Deck2Jokers();
        $this->assertInstanceOf("\App\Card\Deck2Jokers", $deck);

        $res = $deck->getDeck();
        $this->assertNotEmpty($res);
    }

}
