<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
* Test cases for class Card.
*/

class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateCard()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getValue();
        $this->assertNotEmpty($res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties, use arguments.
     */
    public function testCreateCardWithArguments()
    {
        $value = 2;
        $color = "diamond";
        $card = new Card($value, $color);

        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getValue();
        $this->assertNotEmpty($res);
    }

    /**
    * Call getCard() and verify that a string is returned.
    */
    public function testGetCard()
    {
        $card = new Card();
        $this->assertIsString($card->getCard());
    }

    /**
    * Call getCardGraphic() and verify that correct string is returned.
    */
    public function testGetCardGraphic()
    {
        $card = new Card();
        $this->assertEquals('♥', $card->getCardGraphic());

        $card = new Card(1, 'diamond');
        $this->assertEquals('♦', $card->getCardGraphic());

        $card = new Card(1, 'clover');
        $this->assertEquals('♣', $card->getCardGraphic());

        $card = new Card(1, 'joker');
        $this->assertEquals('🃏', $card->getCardGraphic());

        $card = new Card(1, 'spade');
        $this->assertEquals('♠', $card->getCardGraphic());
    }

    /**
    * Call getStringValue() and verify that the correct string is returned.
    */
    public function testGetCardValue()
    {
        $card = new Card(14, 'heart');
        $this->assertEquals('A', $card->getStringValue());

        $card = new Card(11, 'heart');
        $this->assertEquals('J', $card->getStringValue());

        $card = new Card(12, 'heart');
        $this->assertEquals('Q', $card->getStringValue());

        $card = new Card(13, 'heart');
        $this->assertEquals('K', $card->getStringValue());
    }

    /**
    * Call getColor() and verify that a string is returned
    */
    public function testGetColor()
    {
        $card = new Card();

        $this->assertIsString($card->getColor());
    }

    /**
    * Test and verify that setValue() can set the value of a card.
    */
    public function testSetValue()
    {
        $card = new Card();

        $card->setValue(10);

        $this->assertEquals(10, $card->getValue());
    }

    /**
    * Test and verify that isAce() returns a bool value.
    */
    public function testIsAce()
    {
        $card = new Card(1, 'heart');

        $this->assertIsBool($card->isAce());
    }


}
