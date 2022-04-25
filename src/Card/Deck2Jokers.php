<?php

namespace App\Card;

use App\Card\Card;

class Deck2Jokers extends Deck
{
    private int $noOfJokers;

    public function __construct(int $min, int $max, int $noOfJokers)
    {
        $this->noOfJokers = $noOfJokers;
        parent::__construct($min, $max);
        $this->addJokers();
    }

    public function addJokers(): void
    {
        for ($i = 0; $i < $this->noOfJokers; $i++) {
            $card = new Card(0, 'joker');
            array_push($this->deck, $card);
        }
    }
}
