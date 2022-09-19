<?php
namespace App\Controller;



use App\Entity\Partenaire;
use App\SendMail\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
        


    }

    #[Route('admin/partenaire', name: 'app_partenaire')]
    public function index(Request $request, MailerInterface $mailer)
    {
        $notif = null;

        $this->mailer = $mailer;

        $partenaire = new Partenaire();
        $form = $this->createForm(PartenaireType::class, $partenaire);

        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {

            $partenaire = $form->getData();
    
            $this->entityManager->persist($partenaire);
            $this->entityManager->flush();
                
                $email = (new Email())
                ->from('gympectest@gmail.com')
                ->to($partenaire->getMail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Partenaire GymPec')
                ->html('<p>Bonjour ' . $partenaire->getName() . '! Votre compte Partenaire a bien été crée.</p>'
                . '<p>Vous etês partenaire de la structure '.$partenaire->getStructure().'</p>'
                . '<p>Vos identifiant sont: ' . $partenaire->getName() . ' et ' . $partenaire->getMail() . '</p>'
                . '<p> Vous pouvez désormais vous connecter sur le site.</p>');

                $notif = "Votre compte Partenaire a bien été crée.";
    
            $mailer->send($email);
           
        }   
            return $this->renderForm('partenaire/index.html.twig', [
                'form' => $form,
                'notif' => $notif,
  
            ]);
    }
}