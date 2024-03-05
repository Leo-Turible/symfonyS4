<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TwigFilterController extends AbstractController
{
    #[Route('/twig/filter', name: 'app_twig_filter')]
    public function index(): Response
    {
        return $this->render('twig_filter/index.html.twig', [
            'controller_name' => 'TwigFilterController',
        ]);
    }
}
