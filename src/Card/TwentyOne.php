<?php

namespace App\Card;

use App\Card\Player;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class TwentyOne extends Game
{
    protected int $maxScore = 21;

    public function drawCard(SessionInterface $session, int $player, object $deck): int
    {
        $hand = $this->players[$player]->getHandObject();
        if ($this->checkScore($player, $deck)) {
            $hand->addCards(1, $deck);
        }

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

}
