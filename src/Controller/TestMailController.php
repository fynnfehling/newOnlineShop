<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class TestMailController extends AbstractController
{
    #[Route('/test-mail')]
    public function sendSimpleMail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from(new Address('no-reply@localhost.test', 'Dein Shop'))
            ->to('fynnfehling@gmail.com')
            ->subject('Deine erste simple Test-Mail')
            ->text('Hallo! Dies ist der einfache Textinhalt deiner E-Mail.')
            ->html('<p>Hallo! Dies ist der **HTML-Inhalt** deiner E-Mail.</p>');
        $mailer->send($email);
        return new Response('Simple E-Mail erfolgreich gesendet yes sirsky!');
    }

}
