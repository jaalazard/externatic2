<?php

namespace App\Form;

use App\Entity\Consultant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ConsultantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Entrer le prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Entrer le nom'
                ]
            ])
            ->add('location', TextType::class, [
                'label' => 'Secteur',
                'attr' => [
                    'placeholder' => 'Entrer le secteur'
                ]
            ])
            ->add('specialization', TextType::class, [
                'label' => 'Spécialisation',
                'attr' => [
                    'placeholder' => 'Entrer la spécialisation'
                ]
            ])
            ->add('linkedin', TextType::class, [
                'label' => 'Linkedin',
                'attr' => [
                    'placeholder' => 'Entrer le lien Linkedin'
                ]
            ])
            ->add('posterFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true,
                'download_uri' => true,
                'label' => 'Photo de profil']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consultant::class,
        ]);
    }
}
