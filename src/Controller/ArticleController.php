<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $article = new Article();
        $form = $this->createForm(
            ArticleType::class,
            $article,
            [
                'departement' => '75',
            ]
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_article');
        }

        return $this->render('article/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
