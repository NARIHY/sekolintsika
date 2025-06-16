<?php

namespace App\Controller;

use App\Entity\Contact\DemandeAcces;
use App\Form\Contact\DemandeAccesTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactControlleur extends AbstractController
{
    /**
     * Affiche et traite le formulaire de demande d'accès.
     */
    #[Route('/contact', name: 'app_public_contact', methods: ['GET', 'POST'])]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $demande = new DemandeAcces();
        $form = $this->createForm(DemandeAccesTypeForm::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demande->setDateSoumission(new \DateTime());
            $em->persist($demande);
            $em->flush();

            $this->addFlash('success', '✅ Votre demande a été envoyée avec succès !');
            return $this->redirectToRoute('app_public_contact');
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', '❌ Veuillez corriger les erreurs dans le formulaire.');
        }

        return $this->render('contact_controlleur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
