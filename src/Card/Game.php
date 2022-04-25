<?php

namespace App\Card;

use App\Card\Player;

class Game
{
    protected array $players = [];
    protected int $numberOfCards;
    protected int $numberOfPlayers;
    protected object $deck;

    public function __construct(int $players, int $cards, object $deck)
    {
        $this->numberOfPlayers = $players;
        $this->numberOfCards = $cards;
        $this->deck = $deck;
        $this->addPlayer($this->numberOfPlayers, $this->deck);
        $this->giveCards();
    }

    public function addPlayer(int $number): void
    {
        for ($i = 0; $i < $this->numberOfPlayers; $i++) {
            $player = new Player($number, $i);
            array_push($this->players, $player);
        }
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function giveCards(): void
    {
        foreach ($this->players as $player) {
            $player->addHand($this->numberOfCards, $this->deck);
        }
    }
}
