<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Service\GestionContact;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Message;

class MessageController extends AbstractController {

    #[Route('/contact', name: 'demandeContact')]
    public function contact(Request $request, GestionContact $gestionContact): Response {
        $message = new Message();
        $form = $this->createForm(ContactType::class, $message);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();
            $gestionContact->creerContact($message);
            $gestionContact->envoieMailContact($message);
            return $this->redirectToRoute("homepage");
        }
        return $this->render('message/demandeContact.html.twig', [
                    'form' => $form->createView(),
        ]);
    }
}
