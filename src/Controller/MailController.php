<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function index(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('group.project.planner@gmail.com')
            ->to('islamaj.arb@gmail.com') // enter your mail for testing

            // If you want to test the mailer remove my email and put your email or if you want to sent an email to the group, uncomment the line with all our emails.

            // ->to('islamaj.arb@gmail.com', 'borisvk4@gmail.com', 'christian.elger@outlook.com', 'jasks123@gmail.com', 'stavrosanagno@gmail.com')

            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('This is our project email!')
            ->text('Hello web developers!');
        // ->html('<p>See Twig integration for better HTML integration!</p>');

        try {
            $mailer->send($email);
            return new Response("Email sent!");
        } catch (TransportExceptionInterface $error) {
            return new Response("Error: " . $error->getMessage());
        }
    }

    // #[Route('/contact', name: 'app_contact')]
    // public function contact(): Response
    // {
    //     return new Response("Contact works");
    // }
}
