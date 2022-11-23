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

        return $this->render('proj/about.html.twig');
    }

    /**
     * @Route("/proj/poker/game", name="proj/poker/game")
     */
    public function startPoker(SessionInterface $session): Response
    {
        $deck = $session->get("pokerdeck") ?? new \App\Card\Deck(1, 13);
        $deck->shuffleDeck();

        return $this->render('proj/about.html.twig');
    
    }
}