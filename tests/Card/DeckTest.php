<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
* Test cases for class Deck.
*/

class DeckTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDeck()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $res = $deck->getDeck();
        $this->assertNotEmpty($res);
    }

    /**
     * Verify that an int is returned from function DeckLength().
     */
    public function testDeckLength()
    {
        $deck = new Deck();

        $this->assertIsInt($deck->deckLength());
    }

    /**
     * Verify that an array is returned from drawCard().
     */
    public function testDrawCard()
    {
        $deck = new Deck();

        $this->assertIsArray($deck->drawCard());
    }

    /**
     * Verify that an array is returned from shuffleDeck().
     */
    public function testShuffleDeck()
    {
       $deck = new Deck();
       
       $this->assertIsArray($deck->shuffleDeck());
    }

    /**
     * Verify that a deck is sorted with sortDeck().
     */
    public function testSortDeck()
    {
        $deck = new Deck();

        $deck->sortDeck();

        $this->assertGreaterThan($deck->getDeck()[0], $deck->getDeck()[1]);
    }

}
