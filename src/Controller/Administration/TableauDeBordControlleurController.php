<?php

namespace App\Controller\Administration;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class TableauDeBordControlleurController extends AbstractController
{
    #[Route('/administration/tableau/de/bord/controlleur', name: 'app_administration_tableau_de_bord_controlleur')]
    public function index(): Response
    {
        return $this->render('administration/tableau_de_bord_controlleur/index.html.twig', [
            'controller_name' => 'TableauDeBordControlleurController',
        ]);
    }


}
