<?php
namespace App\Controller;

use App\Controller\RegisterType as RegisterType;
use App\Entity\User;
use App\SendMail\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class RegisterController extends AbstractController 
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/register', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $encoder)
    {
        $notif = null;

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $this->entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
            $user->setPassword($encoder->hashPassword($user, $user->getPassword()));
    
            $this->entityManager->persist($user);
            $this->entityManager->flush();

                $mail = new Mail();
                $content = "Bonjour" . $user->getFirstname() . " " . $user->getLastname() . "! Votre compte GymPec a bien été créé. Vous pouvez désormais vous connecter sur le site.";
                $mail->send($user->getEmail(), $user->getFirstname(), 'Welcome to GymPec', 'Welcome to GymPec', $content);
                $notif = "Votre compte a bien été créé";

    
           
        }   
            return $this->renderForm('register/index.html.twig', [
                'form' => $form,
                'notif' => $notif,
  
            ]);
    }
}