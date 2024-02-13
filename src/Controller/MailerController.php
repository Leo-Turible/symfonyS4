<?php

namespace App\Controller;

use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MailerController extends AbstractController
{
    #[Route('/mail', name: 'app_mailer')]
    public function index(
        MailerService $mailerService
    ): Response
    {
        $mailerService->sendMail(
            'test@mail.com',
            'Test',
            'Test message'
        );

        return $this->render('mailer/index.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }

}
