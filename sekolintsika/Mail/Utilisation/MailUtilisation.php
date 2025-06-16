<?php

namespace Sekolintsika\Mail\Utilisation;

use Sekolintsika\Mail\ConstructeurEmail;
use Symfony\Component\Mailer\MailerInterface;

class mailUtilisation {
public function envoyerEmail(MailerInterface $mailer)
{
    $constructeur = (new ConstructeurEmail())
        ->setExpediteur('expediteur@example.com', 'Mon Site')
        ->setDestinataire('destinataire@example.com', 'Jean Dupont')
        ->setSujet('Test Email dynamique')
        ->setContenu('Bonjour, ceci est un email envoyé dynamiquement.');

    $email = $constructeur->getEmail();

    $mailer->send($email);

    header('Content-Type: application/json');
    echo json_encode(['message' => 'Email envoyé !']);
    return;
}
}

