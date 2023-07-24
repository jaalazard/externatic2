<?php

namespace App\Form;

use App\Entity\JobOfferSearch;
use App\DataFixtures\JobOfferFixtures;
use App\Entity\JobOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchJobType extends AbstractType
{
    public const CONTRACTS = [
        'Alternance' => 'Alternance',
        'CDD' => 'CDD',
        'CDI' => 'CDI',
    ];


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('search', SearchType::class, [
                'required' => false,
                'label' => 'MOTS CLÉS',
            ])
            ->add('contract', ChoiceType::class, [
                'choices' => self::CONTRACTS,
                'required' => false,
                'label' => 'CONTRAT',
            ])
            ->add('city', TextType::class, [
                'required' => false,
                'label' => 'Ville',
            ])
            ->add('radius', rangeType::class, [
                'required' => false,
                'label' => 'Rayon',
                'attr' => [
                    'min' => 1,
                    'max' => 500,
                    'value' => 1,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => JobOfferSearch::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
