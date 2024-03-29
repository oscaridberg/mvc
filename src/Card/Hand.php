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
        $cardValues = [];
        $aces = [];

        foreach ($this->cards as $card) {
            if ($card[0]->isAce()) {
                array_push($aces, $card[0]->getValue());
            } else {
                array_push($cardValues, $card[0]->getValue());
            }
        }

        $noOfAces = count($aces);

        for ($i = 0; $i < $noOfAces; $i++) {
            if (array_sum($cardValues) + array_sum($aces) < 21) {
                $aces[$i] = 14;
                if (array_sum($cardValues) + array_sum($aces) > 21) {
                    $aces[$i] = 1;
                }
            }
        }

        $cardSum = array_sum($cardValues) + array_sum($aces);

        return $cardSum;
    }
}
