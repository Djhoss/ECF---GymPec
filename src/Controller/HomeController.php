<?php

namespace App\Controller;

use App\Entity\Product;
use App\SendMail\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class HomeController extends AbstractController
{
    
    
    /**
     * @Route("/", name="app_home")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        // $email = (new Email())
        //     ->from('gympectest@gmail.com')
        //     ->to('you@example.com')
        //     //->cc('cc@example.com')
        //     //->bcc('bcc@example.com')
        //     //->replyTo('fabien@example.com')
        //     //->priority(Email::PRIORITY_HIGH)
        //     ->subject('Time for Symfony Mailer!')
        //     ->text('Sending emails is fun again!')
        //     ->html('<p>See Twig integration for better HTML integration!</p>');

        // $mailer->send($email);

        return $this->render('home/index.html.twig', [
        ]);
    }

    
}

