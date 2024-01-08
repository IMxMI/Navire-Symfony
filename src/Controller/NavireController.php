<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NavireRepository;

#[Route('/', name: 'navire_')]
class NavireController extends AbstractController {

    #[Route('/voirtous', name: 'voirtous')]
    public function voirTous(NavireRepository $repoNavire): Response {
        $navires = $repoNavire->findAll();
        return $this->render('navire/voirtous.html.twig', [
                    'navires' => $navires,
        ]);
    }

    #[Route('/edit', name: 'edit')]
    public function edit(): Response {
        
    }
}
