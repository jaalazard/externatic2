<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('establishment', TextType::class, [
                'label' => 'Établissement',
                'attr' => [
                    'placeholder' => 'Nom de l\'établissement',
                    'class' => 'border-primary',
                ]
            ])
            ->add('diploma', TextType::class, [
                'label' => 'Diplôme',
                'attr' => [
                    'placeholder' => 'Intitulé du diplôme',
                    'class' => 'border-primary',
                ]
            ])
            ->add('start', DateType::class, [
                'label' => 'Date d\'entrée en formation',
                'attr' => [
                    'class' => 'border-primary',
                ],
                'years' => range(2033, 1953)
            ])
            ->add('end', DateType::class, [
                'label' => 'Date de sortie de formation',
                'attr' => [
                    'class' => 'border-primary',
                ],
                'years' => range(2033, 1953)
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'border-primary', 'form-control', 'input-lg',
                    'placeholder' => 'Si vous le souhaitez, ajoutez une courte description de la formation',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
