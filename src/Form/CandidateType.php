<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cvitaeFile', VichFileType::class, [
                'label' => 'Format pdf',
                'attr' => [
                    'class' => 'border-primary',
                ],
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'Ex : 0101010101',
                    'class' => 'border-primary',
                ]
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'Date de naissance',
                'attr' => [
                    'placeholder' => 'Ex : 01/01/1970',
                    'class' => 'border-primary',
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Rue et n° de rue',
                'attr' => [
                    'placeholder' => 'Ex : 1 Avenue du Général de Gaulle',
                    'class' => 'border-primary',
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Ex : Paris',
                    'class' => 'border-primary',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
