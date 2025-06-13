<?php

namespace App\Controller\Public;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AProposControlleur extends AbstractController
{
    #[Route('/A-propos', name: 'app_public_a_propos')]
    public function index(): Response
    {
        return $this->render('public/a_propos_controlleur/index.html.twig', [
            'controller_name' => 'AProposControlleurController',
        ]);
    }
}
