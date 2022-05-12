<?php

namespace App\Card;

use App\Card\Hand;

class Player
{
    protected object $cardHand;
    protected int $cardsPerHand;
    protected int $playerId;

    public function __construct(int $number, int $id)
    {
        $this->cardsPerHand = $number;
        $this->playerId = $id;
    }

    public function addHand(int $number, object $deck): void
    {
        $this->cardHand = new Hand();
        $this->cardHand->addCards($number, $deck);
    }


    public function getHandObject(): object
    {
        return $this->cardHand;
    }

    public function getHand(): array
    {
        $cards = [];

        foreach ($this->cardHand->getCards() as $card) {
            array_push($cards, $card[0]);
        }
        return $cards;
    }

    public function getId(): int
    {
        return $this->playerId;
    }
}
