<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailController extends AbstractController
{
    #[Route('/email', name: 'app_email')]
    public function index(): Response
    {
        return $this->render('email/index.html.twig', [
            'controller_name' => 'EmailController',
        ]);
    }

    #[Route('/sendEmail', name: 'send_email')]
    public function SendEmail(Request $request, MailerInterface $mailer): Response
    {
        $fname = $request->request->get('fname');
        $name = $request->request->get('name');
        $mail = $request->request->get('mail');
        $object = $request->request->get('objet');
        $message = $request->request->get('msg');

        $email = (new Email())
            ->from('josueperrault56@gmail.com')
            ->to($mail)
            ->subject($object)
            ->text($message)
            ->html('<p>Bonjour <b>'. $fname .' '. $name .'</b> !</p> <p>Bienvenue sur mon nouveau site</p> <p>'. $message .'</p>');

        $mailer->send($email);
        return $this->redirectToRoute('validation_email');
    }

    #[Route('/validationemail', name: 'validation_email')]
    public function ValidationEmail(): Response
    {
        return $this->render('email/validationemail.html.twig', [
            'controller_name' => 'EmailController',
        ]);
    }
}
