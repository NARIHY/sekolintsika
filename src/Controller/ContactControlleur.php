<?php

namespace App\Controller;

use App\Entity\Contact\DemandeAcces;
use App\Form\Contact\DemandeAccesTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Sekolintsika\Mail\ConstructeurEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ContactControlleur extends AbstractController
{
    #[Route('/contact', name: 'app_public_contact', methods: ['GET', 'POST'])]
    public function contact(
        Request $request,
        EntityManagerInterface $em,
        MailerInterface $mailer
    ): Response {
        $demande = new DemandeAcces();
        $form = $this->createForm(DemandeAccesTypeForm::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->handleValidForm($demande, $em, $mailer);
                $this->addFlash('success', '✅ Votre demande a été envoyée avec succès !');
                return $this->redirectToRoute('app_public_contact');
            }
            $this->addFlash('error', '❌ Veuillez corriger les erreurs dans le formulaire.');
        }

        return $this->render('contact_controlleur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function handleValidForm(
        DemandeAcces $demande,
        EntityManagerInterface $em,
        MailerInterface $mailer
    ): void {
        $demande->setDateSoumission(new \DateTime());
        $em->persist($demande);
        $em->flush();

        $this->envoyerEmailConfirmation(
            $mailer,
            $demande->getEmail(),
            $demande->getNomComplet()
        );
    }

    private function envoyerEmailConfirmation(
        MailerInterface $mailer,
        string $destinataire,
        string $nomComplet
    ): void {
        $salutation = $this->getSalutation();
        $contenu = sprintf(
            "%s, nous avons bien reçu votre demande d'accès à notre plateforme. Nous la traiterons dans les plus brefs délais. Merci de votre confiance.",
            $salutation
        );

        $constructeur = (new ConstructeurEmail())
            ->setExpediteur('no-reply@sekolintsika.mg', 'Sekolintsika')
            ->setDestinataire($destinataire, $nomComplet)
            ->setSujet("Confirmation de votre demande d'accès")
            ->setContenu($contenu);

        $mailer->send($constructeur->getEmail());
    }

    private function getSalutation(): string
    {
        $heure = (int) (new \DateTime())->format('H');
        return match (true) {
            $heure < 12 => 'Bonjour',
            $heure < 18 => 'Bon après-midi',
            default => 'Bonsoir',
        };
    }
}
