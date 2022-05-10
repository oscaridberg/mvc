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

    public function home(): Response
    {
        $data = [
            'title' => 'Twenty-One'
        ];

        return $this->render('game/home.html.twig', $data);
    }

    /**
     * @Route("/game/twentyone", name="twentyone")
     */

    public function startGame(): Response
    {
        $data = [
            'title' => 'Twenty-One'
        ];

        return $this->render('game/game.html.twig', $data);
    }
}
