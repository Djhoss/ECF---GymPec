<?php
namespace App\Controller;

use App\Entity\Partenaire;
use App\Entity\Structure;
use App\SendMail\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class StructureController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
        


    }

    #[Route('admin/structure', name: 'app_structure')]
    public function index(Request $request, MailerInterface $mailer)
    {
        $notif = null;

        $this->mailer = $mailer;
    

        $structure = new Structure();
        $form = $this->createForm(StructureType::class, $structure);

        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {

            $structure = $form->getData();

    
            $this->entityManager->persist($structure);
            $this->entityManager->flush();

                $email = (new Email())
                ->from('gympectest@gmail.com')
                ->to($structure->getMail())
                // ->cc())
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('structure GymPec')
                ->html('<p>Bonjour ' . $structure->getName() . '! Votre compte structure a bien été crée.</p>'
                . '<p>Vous etês reponsable de '.$structure->getPartenaire().'</p>'
                . '<p>Vos identifiant sont: ' . $structure->getName() . ' et ' . $structure->getMail() . '</p>'
                . '<p> Vous pouvez désormais mofidier votre structure sur le site, n\'oubliez pas d\'ajouter une image a votre structure et d\'activer votre structure pour la mettre a jour sur notre site.</p>');

                $notif = "Votre compte structure a bien été crée.";
    
            $mailer->send($email);
           
        }   
            return $this->renderForm('structure/index.html.twig', [
                'form' => $form,
                'notif' => $notif,
  
            ]);
    }
}