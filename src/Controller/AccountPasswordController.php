<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;



class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/account/change_password', name: 'app_account_password')]

    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $notif = null;
        $fail = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('old_password')->getData();
            $user = $form->getData();


            if($passwordHasher->isPasswordValid($user, $old_pwd)) {
                $new_pwd = $form->get('new_password')->getData();
                $user->setPassword($passwordHasher->hashPassword($user, $new_pwd));
                
                $this->entityManager->persist($user);
                $this->entityManager->flush(); 
                $notif = 'Votre mot de passe a été modifié avec succès !';
            } else {
                $fail = 'Votre mot de passe actuel est incorrect !';
            }
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notif' => $notif,
            'fail' => $fail
        ]);
    }
}
