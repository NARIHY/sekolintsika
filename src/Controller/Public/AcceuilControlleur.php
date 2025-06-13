<?php

namespace App\Controller\Public;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AcceuilControlleur extends AbstractController
{
    #[Route('/', name: 'app_public_acceuil')]
    public function index(): Response
    {
        return $this->render('public/acceuil_controlleur/index.html.twig', [
            'controller_name' => 'AcceuilControlleurController',
        ]);
    }
}
