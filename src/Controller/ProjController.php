<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class ProjController extends AbstractController
{
    /**
     * @Route("/proj", name="proj")
     */
    public function home(): Response
    {
        return $this->render('proj/proj.html.twig');
    }

    /**
     * @Route("/proj/about", name="proj/about")
     */
    public function about(): Response
    {
        return $this->render('proj/about.html.twig');
    }

    /**
     * @Route("/proj/poker", name="proj/poker")
     */
    public function pokerHome(SessionInterface $session): Response
    {
        $deck = $session->set("pokerdeck", new \App\Card\Deck(1, 13));

        return $this->render('proj/pokerhome.html.twig');
    }

    /**
     * @Route("/proj/poker/game", name="proj/poker/game")
     */
    public function startPoker(SessionInterface $session): Response
    {
        $deck = $session->get("pokerdeck") ?? new \App\Card\Deck(1, 13);
        $deck->shuffleDeck();

        $game = $session->set("pokergame", new \App\Card\Poker(2, 0, $deck));
        $game = $session->get("pokergame");

        $data = [
            'title' => 'Five-Card-Poker',
            'players' => $game->getPlayers(),
            'length' => $deck->deckLength(),
        ];

        return $this->render('proj/game.html.twig', $data);

        // return $this->render('proj/about.html.twig');
    
    }

    /**
     * @Route("/proj/poker/game/draw", name="drawpoker")
     * method={"GET"}
     */
    public function draw(SessionInterface $session): Response
    {
        $this->resetDeck($session);
        $deck = $session->get("pokerdeck");
        $game = $session->get("pokergame");
        $game->drawCard($session, 1, $deck);
        $game->drawCard($session, 0, $deck);
        $data = [
            'title' => 'Five-Card-Poker',
            'players' => $game->getPlayers(),
            'length' => $deck->deckLength(),
            'score' => $game->getPlayerScore(1),
            'isStarted' => $game->isStarted()
        ];


        return $this->render('proj/game.html.twig', $data);
    }

    public function resetDeck(SessionInterface $session)
    {
        $deck = $session->get("pokerdeck");
        if ($deck->deckLength() <= 5) {
            $session->set("pokerdeck", new \App\Card\Deck(1, 13));
        }
    }
}