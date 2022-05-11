<?php

namespace App\Card;

use App\Card\Player;


class TwentyOne extends Game
{
    protected int $maxScore = 21;

    public function drawCard(int $player, object $deck): int
    {
        $hand = $this->players[$player]->getHandObject();
        if ($this->checkScore($player, $deck)) {
            $hand->addCards(1, $deck);
        }

        // print_r($hand->sumCards());
        return $hand->sumCards();
    }

    public function checkScore(int $player, object $deck): bool
    {
        $playerHand = $this->players[$player]->getHandObject();

        return $playerHand->sumCards() < $this->maxScore;

    }

    public function getPlayerScore(int $player): int {
        return $this->players[$player]->getHandObject()->sumCards();
    }

    public function dealer(int $player, object $deck) {
        $maxScore = 21;
        $dealer = $this->players[$player];
        $dealerHand = $dealer->getHandObject();

        while ($dealerHand->sumCards() <= 17) {
            $dealerHand->addCards(1, $deck);
        }

        return $dealerHand->sumCards();
    }

    public function decideWinner(): string {
        $dealer = $this->players[0]->getPlayerScore();
        $player = $this->players[1]->getPlayerScore();
        $winner = '';
        $maxScore = 21;
        if ($player > $maxScore) {
            $winner = 'Dealer';
        } elseif ($dealer > $maxScore and $player <= $maxScore) {

        }

        return $winner;
    }
}
