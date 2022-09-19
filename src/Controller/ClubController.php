<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Filtre\Search;
use App\Form\SearchClubType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/nos-clubs', name: 'app_club')]
    public function index(Request $request): Response
    {
        $structures = $this->entityManager->getRepository(Structure::class)->findAll();

        $search = new Search();
        $form = $this->createForm(SearchClubType::class, $search);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $structures = $this->entityManager->getRepository(Structure::class)->findWithSearch($search);
        }

        return $this->render('club/index.html.twig', [
            'structures' =>$structures,
            'form' => $form->createView()
        ]);
    }

    #[Route('/club/{city}', name: 'app_club_show')]
    public function show($city): Response
    {
        $structure = $this->entityManager->getRepository(Structure::class)->findOneByCity($city);

        if(!$structure) {
            throw $this->redirectToRoute('app_club');
        }

        return $this->render('club/showClub.html.twig', [
            'structure' => $structure
        ]);
    }
}