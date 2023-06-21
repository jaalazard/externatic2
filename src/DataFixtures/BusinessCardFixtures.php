<?php

namespace App\DataFixtures;

use App\Entity\BusinessCard;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BusinessCardFixtures extends Fixture
{
    public const JOBS = [
        [
            'name' => 'Développeur Back End',
            'link' => 'https://www.externatic.fr/metiers/developpeur-back-end/',
        ],

        [
            'name' => 'Développeur Front End',
            'link' => 'https://www.externatic.fr/metiers/developpeur-front-end/',
        ],

        [
            'name' => 'Développeur Full Stack',
            'link' => 'https://www.externatic.fr/metiers/developpeur-full-stack/',
        ],

        [
            'name' => 'DevOps',
            'link' => 'https://www.externatic.fr/metiers/page-metier-devops/',
        ],

        [
            'name' => 'Lead Technique',
            'link' => 'https://www.externatic.fr/metiers/lead-technique/',
        ],

        [
            'name' => 'Architecte Infrastructure',
            'link' => 'https://www.externatic.fr/metiers/architecte-infrastructure/',
        ],

        [
            'name' => 'Scrum Master',
            'link' => 'https://www.externatic.fr/metiers/scrum-master/',
        ],

        [
            'name' => 'Product Owner',
            'link' => 'https://www.externatic.fr/metiers/product-owner/',
        ],

        [
            'name' => 'Product Manager',
            'link' => 'https://www.externatic.fr/metiers/product-manager/',
        ],

        [
            'name' => 'Ingenieur Test',
            'link' => 'https://www.externatic.fr/metiers/ingenieur-test/',
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
}
