<?php

namespace App\Form\Contact;

use App\Entity\Contact\DemandeAcces;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeAccesTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet', TextType::class, [
                'label' => 'Nom complet *',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email *',
                'required' => true,
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone',
                'required' => false,
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status *',
                'required' => true,
                'choices' => [
                    'Lycéen' => 'lyceen',
                    'Étudiant universitaire' => 'etudiant',
                    'Enseignant' => 'enseignant',
                    'Représentant d\'établissement' => 'etablissement',
                    'Autre' => 'autre',
                ],
            ])
            ->add('institution', TextType::class, [
                'label' => 'Établissement/Institution',
                'required' => false,
            ])
            ->add('sujet', ChoiceType::class, [
                'label' => 'Sujet de votre demande *',
                'required' => true,
                'choices' => [
                    'Demande d\'accès gratuit (1ère année)' => 'acces-gratuit',
                    'Demande d\'informations' => 'information',
                    'Proposition de partenariat' => 'partenariat',
                    'Demande de démonstration' => 'demo',
                    'Autre' => 'autre',
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message *',
                'required' => true,
                'attr' => ['placeholder' => 'Décrivez votre demande en détail...']
            ])
            ->add('submit', SubmitType::class, [
                'label' => '🚀 Envoyer ma demande'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeAcces::class,
        ]);
    }
}
