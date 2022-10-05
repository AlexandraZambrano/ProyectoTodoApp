<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    #[Route('/landing', name: 'app_landing')]
    public function index(): Response
    {
        return $this->render('landing/index.html.twig', [
            'controller_name' => 'LandingController',
        ]);
    }

    #[Route('/', name: 'app_todolist_landing')]
    public function landing()
    {
        return $this->render('landingP/greet.html.twig');
    }
}
