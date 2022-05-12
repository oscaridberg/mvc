<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */

    public function home(SessionInterface $session): Response
    {
        $deck = $session->set("deck21", new \App\Card\Deck(1, 13));
        $data = [
            'title' => 'Twenty-One'
        ];

        return $this->render('game/home.html.twig', $data);
    }
    /**
     * @Route("/game/twentyone", name="twentyone")
     */
    public function startGame(SessionInterface $session): Response
    {

        $deck = $session->get("deck21") ?? new \App\Card\Deck(1, 13);
        $deck->shuffleDeck();

        $game = $session->set("game21", new \App\Card\TwentyOne(2, 0, $deck));
        $game = $session->get("game21");


        $data = [
            'title' => 'Twenty-One',
            'players' => $game->getPlayers(),
            'length' => $deck->deckLength(),
        ];

        return $this->render('game/game.html.twig', $data);
    }
    /**
     * @Route("/game/twentyone/draw", name="draw21")
     * method={"GET"}
     */
    public function draw(SessionInterface $session): Response
    {
        $this->resetDeck($session);
        $deck = $session->get("deck21");
        $game = $session->get("game21");
        $game->drawCard($session, 1, $deck);
        $data = [
            'title' => 'Twenty-One',
            'players' => $game->getPlayers(),
            'length' => $deck->deckLength(),
            'score' => $game->getPlayerScore(1)
        ];

        if ($game->getPlayerScore(1) >= 21) {
            return $this->redirectToRoute('stay');
        }

        return $this->render('game/game.html.twig', $data);
    }

    /**
     * @Route("/game/stay", name="stay")
     */

    public function stay(SessionInterface $session): Response
    {
        $this->resetDeck($session);
        $deck = $session->get("deck21");
        $game = $session->get("game21");
        if ($game->getPlayerScore(1) <= 21) {
            $game->dealer(0, $deck);
        }

        $data = [
            'title' => $game->decideWinner(),
            'winner' => true,
            'players' => $game->getPlayers(),
            'length' => $deck->deckLength(),
            'score' => $game->getPlayerScore(1),
            'dealer' => $game->getPlayerScore(0)
        ];

        return $this->render('game/game.html.twig', $data);
    }

    /**
     * @Route("/game/doc", name="doc")
     */

    public function doc(): Response
    {
        $data = [
            'title' => 'Twenty-One Doc'
        ];

        return $this->render('game/doc.html.twig', $data);
    }

    /**
     * @Route("/game/quit", name="quit")
     */

    public function quit(SessionInterface $session): Response
    {
        $deck = $session->set("deck21", new \App\Card\Deck(1, 13));
        $deck = $session->get("deck21");
        $game = $session->set("game21", new \App\Card\TwentyOne(2, 0, $deck, 21));


        return $this->redirectToRoute('game');
    }

    /**
     * @Route("/game/next", name="next")
     */

    public function next(SessionInterface $session): Response
    {

        return $this->redirectToRoute('twentyone');
    }

    public function resetDeck(SessionInterface $session)
    {
        $deck = $session->get("deck21");
        if ($deck->deckLength() <= 0) {
            $session->set("deck21", new \App\Card\Deck(1, 13));
        }
    }
}
