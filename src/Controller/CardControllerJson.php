<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardControllerJson extends AbstractController
{
    /**
     * @Route("/api/card")
     */

    public function card(): Response
    {
        $data = [
            'title' => 'Card'
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/card/deck")
     * method={"GET"}
     */

    public function deck(SessionInterface $session): Response
    {
        $deck = $session->get("deck") ?? new \App\Card\Deck(1, 13);
        $deck->sortDeck();
        $json_deck = [];
        foreach ($deck->getDeck() as $card) {
            array_push($json_deck, "{$card->getCardGraphic()} {$card->getValue()}");
        }
        $data = [
           'title' => 'Deck',
           'deck' => $json_deck,
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
