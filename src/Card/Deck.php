<?php

namespace App\Card;

use App\Card\Card;

class Deck
{
    private array $colors = ['heart', 'diamond', 'clover', 'spade'];

    private int $min;

    public int $max;

    protected array $deck = [];

    public function __construct(int $min=1, int $max=52)
    {
        $this->min = $min;
        $this->max = $max;
        $this->createDeck();
    }

    public function createDeck(): void
    {
        foreach ($this->colors as $color) {
            foreach (range($this->min, $this->max) as $number) {
                $card = new Card($number, $color);
                array_push($this->deck, $card);
            }
        }
    }

    public function getDeck(): array
    {
        return $this->deck;
    }

    public function sortDeck(): void
    {
        sort($this->colors);
        $sortedDeck = [];
        foreach ($this->colors as $color) {
            $tempDeck = [];
            foreach ($this->deck as $card) {
                if ($card->getColor() == $color) {
                    array_push($tempDeck, $card);
                }
            }
            sort($tempDeck);
            foreach ($tempDeck as $card) {
                array_push($sortedDeck, $card);
            }
        }
        $this->deck = $sortedDeck;
    }

    public function shuffleDeck(): array
    {
        shuffle($this->deck);
        return $this->deck;
    }

    public function drawCard(int $number = 1): array
    {
        $cards = [];

        if ($number > $this->deckLength()) {
            $card = null;
        } else {
            for ($i = 0; $i < $number; $i++) {
                $card = $this->deck[$i];
                array_push($cards, $card);
                unset($this->deck[$i]);
                $this->deck = array_values($this->deck);
            }
        }

        return $cards;
    }

    public function deckLength(): int
    {
        return count($this->deck);
    }
}
// $testDeck = new Deck(1, 13);
// $testDeck->createDeck();
// $testDeck->sortDeck();
