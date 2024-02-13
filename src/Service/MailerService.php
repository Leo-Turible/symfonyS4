<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public const MAILER_FROM = 'webmaster@mail.com';
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendMail(string $to, string $sujet, string $message)
    {
        $email = (new Email())
            ->from(self::MAILER_FROM)
            ->to($to)
            ->subject($sujet)
            ->text($message);

        $this->mailer->send($email);
    }
}