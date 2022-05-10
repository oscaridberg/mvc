<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card")
     */
    public function card(): Response
    {
        $data = [
            'title' => 'Card',
            'link_to_deal' => $this->generateUrl('Deal')
        ];
        return $this->render('card/card.html.twig', $data);
    }

    /**
     * @Route("/card/deck", name="deck")
     * method={"GET"}
     */
    public function deck(SessionInterface $session): Response
    {
        $deck = $session->get("deck") ?? new \App\Card\Deck(1, 13);
        $deck->sortDeck();
        $data = [
            'title' => 'Deck',
            'deck' => $deck->getDeck(),
            'length' => $deck->deckLength(),
            'link_to_deal' => $this->generateUrl('Deal')


        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck2", name="deck2jokers")
     * method={"GET"}
     */
    public function deck2jokers(SessionInterface $session): Response
    {
        $session->set("deck", new \App\Card\Deck2Jokers(1, 13, 2));
        $deck = $session->get("deck") ?? new \App\Card\Deck2Jokers(1, 13, 2);
        // $deck->sortDeck();
        $data = [
            'title' => 'Deck',
            'deck' => $deck->getDeck(),
            'length' => $deck->deckLength(),
            'link_to_deal' => $this->generateUrl('Deal')


        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/shuffle", name="shuffle")
     * method={"POST"}
     */
    public function shuffleDeck(SessionInterface $session): Response
    {
        $session->set("deck", new \App\Card\Deck(1, 13));
        $deck = $session->get("deck") ?? new \App\Card\Deck(1, 13);
        $data = [
            'title' => 'Deck',
            'deck' => $deck->shuffleDeck(),
            'length' => $deck->deckLength(),
            'link_to_deal' => $this->generateUrl('Deal')

        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw", name="draw")
     * methods={"GET"}
     */
    public function draw(SessionInterface $session): Response
    {
        $deck = $session->get("deck") ?? new \App\Card\Deck(1, 13);

        $data = [
            'title' => 'Draw',
            'deck' => $deck->drawCard(),
            'length' => $deck->deckLength(),
            'link_to_deal' => $this->generateUrl('Deal')

        ];
        return $this->render('card/deck.html.twig', $data);
    }
    /**
     * @Route("/card/deck/draw/{number}", name="drawnum")
     * method={"GET"}
     */
    public function drawNum(int $number, SessionInterface $session): Response
    {
        $deck = $session->get("deck") ?? new \App\Card\Deck(1, 13);
        $data = [
            'title' => 'Draw',
            'deck' => $deck->drawCard($number),
            'length' => $deck->deckLength(),
            'link_to_deal' => $this->generateUrl('Deal')

        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/deal/{players}/{cards}", name="deckGame")
     * method={"GET"}
     */
    public function startGame(int $players, int $cards, SessionInterface $session): Response
    {
        $deck = $session->get("deck") ?? new \App\Card\Deck(1, 13);
        // print_r($deck);
        $game = $session->get("game") ?? new \App\Card\Game($players, $cards, $deck);
        $data = [
            'title' => 'Game',
            'players' => $game->getPlayers(),
            'length' => $deck->deckLength(),
            'link_to_deal' => $this->generateUrl('Deal'),
            'nPlayers' => $players,
            'nCards' => $cards
        ];

        return $this->render('card/game.html.twig', $data);
    }

    /**
     * @Route("/card/deck/deal/", name="Deal")
     * method={"POST"}
     */
    public function deal(SessionInterface $session, Request $request): Response
    {
        $nPlayers = $request->request->get('nPlayers');
        $nCards = $request->request->get('nCards');

        return $this->startGame($nPlayers, $nCards, $session);
    }
}
