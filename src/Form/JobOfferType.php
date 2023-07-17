<?php

namespace App\Form;

use App\Entity\JobOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('job', TextType::class, [
                'label' => 'Métier',
                'attr' => [
                    'placeholder' => 'Sélectionnez un métier pour cette offre',
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Ville',
                ]
            ])
            ->add('contract', TextType::class, [
                'label' => 'Contract',
                'attr' => [
                    'placeholder' => 'Sélectionnez un métier pour cette offre',
                ]
            ])
            ->add('entreprise', TextType::class, [
                'label' => 'Entreprise',
                'attr' => [
                    'placeholder' => 'Indiquez l\'entreprise',
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description brève',
                'attr' => [
                    'placeholder' => 'Décrivez cette offre brièvement',
                ]
            ])

            ->add('synopsis', TextareaType::class, [
                'label' => 'Description complète',
                'attr' => [
                    'placeholder' => 'Décrivez cette offre dans les détails',
                ]
            ])

            ->add('profil', TextareaType::class, [
                'label' => 'Profil',
                'attr' => [
                    'placeholder' => 'Décrivez le profil recherché',
                ]
            ])
            ->add('createdAt', DateType::class, [
                'label' => 'Date de la publication de cette offre',
            ])

            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'Rentrez votre numéro de mobile',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
