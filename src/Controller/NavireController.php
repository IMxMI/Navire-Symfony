<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NavireRepository;
use App\Form\NavireType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/', name: 'navire_')]
class NavireController extends AbstractController {

    #[Route('/voirtous', name: 'voirtous')]
    public function voirTous(NavireRepository $repoNavire): Response {
        $navires = $repoNavire->findAll();
        return $this->render('navire/voirtous.html.twig', [
                    'navires' => $navires,
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(int $id, NavireRepository $repoNavire, Request $request, EntityManagerInterface $em ): Response {
        $navire = $repoNavire->findOneById($id);
        $form = $this->createForm(NavireType::class, $navire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $navire = $form->getData();
            $em->persist($navire);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('navire/edit.html.twig', [
                    'form' => $form->createView(),
                    'navire' => $navire,
        ]);
    }
}
