<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \App\Repository\AisShipTypeRepository;

#[Route('/aisshiptype', name: 'aisshiptype')]
class AisShipTypeController extends AbstractController {

    #[Route('/voirtous', name: 'voirtous')]
    public function voirTous(AisShipTypeRepository $repoAisShipType): Response {
        $aisShipTypes = $repoAisShipType->findAll();
        return $this->render('aisshiptype/voirtous.html.twig', [
                    'aisShipTypes' => $aisShipTypes,
        ]);
    }
}
