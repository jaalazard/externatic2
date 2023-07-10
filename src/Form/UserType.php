<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public const ROLES = [
        'Candidat' => 'ROLE_CANDIDATE',
        'Consultant' => 'ROLE_CONSULTANT',
        'Administrateur' => 'ROLE_ADMIN',
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'expanded' => true,
                'multiple' => true,
                'choices' => self::ROLES,
            ]);
    }
}
