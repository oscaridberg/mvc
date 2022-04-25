<?php

namespace App\Card;

use App\Card\Deck;

class Hand
{
    protected array $cards = [];

    public function addCards(int $number, object $deck): void
    {
        for ($i = 0; $i < $number; $i++) {
            array_push($this->cards, $deck->drawCard());
        }
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function sumCards(): int
    {
        $value = 0;
        foreach ($this->cards as $card) {
            $vaule += $card->getValue();
        }

        return $value;
    }
}
