<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrincipalController extends AbstractController {

    #[Route('/homepage', name: 'homepage')]
    public function index(): Response {
        return $this->render('principal/home.html.twig');
    }
}
