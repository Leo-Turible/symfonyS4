<?php

namespace App\Controller;

use App\Repository\AdresseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeController extends AbstractController
{
    #[Route('/{_locale}/', name: 'app_home')]
    public function index(TranslatorInterface $translator, AdresseRepository $adresseRepository): Response
    {
        $adresses = $adresseRepository->findOneBySomeField('10000');
        $translated = $translator->trans('Symfony is great');
        //....
        return $this->render('home/index.html.twig', [
            'translated' => $translated,
            'adresses' => $adresses
        ]);
    }
}
