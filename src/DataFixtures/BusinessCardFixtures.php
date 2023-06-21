<?php

namespace App\DataFixtures;

use App\Entity\BusinessCard;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BusinessCardFixtures extends Fixture implements DependentFixtureInterface
{
    public const JOBS = [
        [
            'name' => 'Développeur Back End',
            'link' => 'https://www.externatic.fr/metiers/developpeur-back-end/',
            'category'  => 'category_Technologies',
        ],

        [
            'name' => 'Développeur Front End',
            'link' => 'https://www.externatic.fr/metiers/developpeur-front-end/',
            'category'  => 'category_Technologies',
        ],

        [
            'name' => 'Développeur Full Stack',
            'link' => 'https://www.externatic.fr/metiers/developpeur-full-stack/',
            'category'  => 'category_Technologies',
        ],

        [
            'name' => 'DevOps',
            'link' => 'https://www.externatic.fr/metiers/page-metier-devops/',
            'category'  => 'category_Technologies',
        ],

        [
            'name' => 'Lead Technique',
            'link' => 'https://www.externatic.fr/metiers/lead-technique/',
            'category'  => 'category_Technologies',
        ],

        [
            'name' => 'Architecte Infrastructure',
            'link' => 'https://www.externatic.fr/metiers/architecte-infrastructure/',
            'category'  => 'category_Technologies',
        ],

        [
            'name' => 'Scrum Master',
            'link' => 'https://www.externatic.fr/metiers/scrum-master/',
            'category'  => 'category_Technologies',
        ],

        [
            'name' => 'Product Owner',
            'link' => 'https://www.externatic.fr/metiers/product-owner/',
            'category'  => 'category_Technologies',
        ],

        [
            'name' => 'Product Manager',
            'link' => 'https://www.externatic.fr/metiers/product-manager/',
            'category'  => 'category_Technologies',
        ],

        [
            'name' => 'Ingenieur Test',
            'link' => 'https://www.externatic.fr/metiers/ingenieur-test/',
            'category'  => 'category_Technologies',
        ],

        ];


    public function load(ObjectManager $manager): void
    {


        foreach (self::JOBS as $jobs) {
            $businessCard = new BusinessCard();
            $businessCard->setName($jobs['name']);
            $businessCard->setLink($jobs['link']);
            $manager->persist($businessCard);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          BusinessCardCategoryFixtures::class,
        ];
    }
}
