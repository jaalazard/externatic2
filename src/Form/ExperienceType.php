<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jobTitle', TextType::class, [
                'label' => 'Intitulé du poste',
                'attr' => [
                    'placeholder' => 'Ex : Chauffeur-livreur',
                    'class' => 'border-primary',
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Entreprise',
                'attr' => [
                    'placeholder' => 'Ex: SARL Exemple',
                    'class' => 'border-primary',
                ]
            ])
            ->add('start', DateType::class, [
                'label' => 'Date de début',
                'attr' => [
                    'class' => 'border-primary',
                ],
                'years' => range(2033, 1953)
            ])
            ->add('end', DateType::class, [
                'label' => 'Date de fin',
                'attr' => [
                    'class' => 'border-primary',
                ],
                'years' => range(2033, 1953)
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'border-primary', 'form-control', 'input-lg',
                    'placeholder' => 'Si vous le souhaitez, ajoutez une courte description de cette expérience',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
