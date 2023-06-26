<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchJobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('search', SearchType::class, [
            'label' => 'MOTS CLÉS',
        ])
        ->add('city', SearchType::class, [
            'label' => 'LIEU',
        ])
        ->add('category', SearchType::class, [
            'label' => 'CATÉGORIES'
        ])
        ->add('contract', SearchType::class, [
            'label' => 'TYPE DE CONTRAT'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
