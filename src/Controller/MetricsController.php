<?php

namespace App\Controller;

use App\Entity\Metrics;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\MetricsRepository;
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
