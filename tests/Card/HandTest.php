<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
* Test cases for class Hand.
*/

class HandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use arguments.
     */
    public function testHand()
    {   
        $hand = new Hand();
        $this->assertInstanceOf("\App\Card\Hand", $hand);
    }

    public function testGetCards()
    {
        $hand = new Hand();
        $this->assertIsArray($hand->getCards());
    }

    public function testSumCards()
    {
        $hand = new Hand();
        $this->assertIsInt($hand->sumCards());
    }

}
