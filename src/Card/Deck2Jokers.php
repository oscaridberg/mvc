<?php

namespace App\Card;

use App\Card\Card;

class Deck2Jokers extends Deck
{
    private int $noOfJokers;

    public function __construct(int $min = 1, int $max = 52, int $noOfJokers = 2)
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
