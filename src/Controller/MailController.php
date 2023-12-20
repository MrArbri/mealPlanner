<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
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
    // public function contact(MailerInterface $mailer): Response
    // {
    //     $email = (new Email())
    //         ->from('')
    //         ->to('group.project.planner@gmail.com')
    //         ->subject('New email from contact form!')
    //         ->text('');

    //     try {
    //         $mailer->send($email);
    //         return new Response("Email sent!");
    //     } catch (TransportExceptionInterface $error) {
    //         return new Response("Error: " . $error->getMessage());
    //     }
    // }

    #[Route('/contact', name: 'app_contact')]
    public function contact(
        Request $request,
        UserRepository $userRepository,
        MailerInterface $mailer
    ): Response {
        if ($this->getUser()) {
            $connected = $this->getUser();
            $useremail = $connected->getUserIdentifier();

            $user = $userRepository->findOneBy(['username' => $useremail]);

            $form = $this->createForm(ContactType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $userEmail = $this->getUser();
                $contactFormData = $form->getData();
                $firstName = $form->get("first_name")->getData();
                $lastName = $form->get("last_name")->getData();

                $userEmail = $form->get("email")->getData();
                $message = $form->get("message")->getData();

                $email = (new TemplatedEmail())
                    ->from('fabien@example.com')
                    ->to(new Address('group.project.planner@gmail.com'))
                    ->subject('Thanks for signing up!')

                    // path of the Twig template to render
                    ->htmlTemplate('mail/index.html.twig')

                    // change locale used in the template, e.g. to match user's locale
                    ->locale('de')

                    // pass variables (name => value) to the template
                    ->context([
                        'expiration_date' => new \DateTime('+7 days'),
                        'username' => $user->getFirstName(),
                        'fname' => $firstName,
                        'lname' => $lastName,
                        'userEmail' => $userEmail,
                        'msg' => $message,


                    ]);
                $mailer->send($email);

                $this->addFlash('success', 'Thank you, an employee will contact you soon!');

                return $this->redirectToRoute('app_contact');
            }

            return $this->render('mail/index.html.twig', [
                'form' => $form->createView()
            ]);
        } else {

            $connected = $this->getUser();
            $form = $this->createForm(ContactType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $firstName = $form->get("first_name")->getData();
                $lastName = $form->get("last_name")->getData();
                $userEmail = "not Registered User";
                $userEmail = $form->get("email")->getData();
                $message = $form->get("message")->getData();
                $username = "guest";
                $email = (new TemplatedEmail())
                    ->from('fabien@example.com')
                    ->to(new Address('group.project.planner@gmail.com'))
                    ->subject('Thanks for signing up!')

                    // path of the Twig template to render
                    ->htmlTemplate('mail/index.html.twig')

                    // change locale used in the template, e.g. to match user's locale
                    ->locale('de')

                    // pass variables (name => value) to the template
                    ->context([
                        'expiration_date' => new \DateTime('+7 days'),
                        'username' => $username,
                        'fname' => $firstName,
                        'lname' => $lastName,
                        'userEmail' => $userEmail,
                        'msg' => $message,


                    ]);
                $mailer->send($email);

                $this->addFlash('success', 'Thank you, an employee will contact you soon!');

                return $this->redirectToRoute('app_contact');
            }

            return $this->render('mail/index.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }
}
