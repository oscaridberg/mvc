<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetricsController extends AbstractController
{
    /**
     * @Route("/metrics", name="metrics")
     */
    public function home(): Response
    {
        return $this->render('metrics.html.twig');
    }
}
