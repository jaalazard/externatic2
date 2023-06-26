<?php

namespace App\Form;

use App\Entity\JobOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SearchJobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('search', SearchType::class, [
                'required' => false,
                'label' => 'MOTS CLÉS',
            ])
            ->add('city', EntityType::class, [
                'class' => JobOffer::class,
                'choice_label' => function (?JobOffer $jobOffer): string {
                    return $jobOffer ? $jobOffer->getCity() : '';
                },
                'choice_value' => function (?JobOffer $jobOffer): string {
                    return $jobOffer ? $jobOffer->getCity() : '';
                },
                'required' => false,
                'label' => 'LIEU',
            ])
            ->add('contract', EntityType::class, [
                'class' => JobOffer::class,
                'choice_label' => function (?JobOffer $jobOffer): string {
                    return $jobOffer ? $jobOffer->getContract() : '';
                },
                'choice_value' => function (?JobOffer $jobOffer): string {
                    return $jobOffer ? $jobOffer->getContract() : '';
                },
                'required' => false,
                'label' => 'TYPE DE CONTRAT',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
