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
            'category'  => 'category_tech',
        ],

        [
            'name' => 'Développeur Front End',
            'link' => 'https://www.externatic.fr/metiers/developpeur-front-end/',
            'category'  => 'category_tech',
        ],

        [
            'name' => 'Développeur Full Stack',
            'link' => 'https://www.externatic.fr/metiers/developpeur-full-stack/',
            'category'  => 'category_tech',
        ],

        [
            'name' => 'DevOps',
            'link' => 'https://www.externatic.fr/metiers/page-metier-devops/',
            'category'  => 'category_tech',
        ],

        [
            'name' => 'Lead Technique',
            'link' => 'https://www.externatic.fr/metiers/lead-technique/',
            'category'  => 'category_tech',
        ],

        [
            'name' => 'Architecte Infrastructure',
            'link' => 'https://www.externatic.fr/metiers/architecte-infrastructure/',
            'category'  => 'category_tech',
        ],

        [
            'name' => 'Product Owner',
            'link' => 'https://www.externatic.fr/metiers/product-owner/',
            'category'  => 'category_tech',
        ],

        [
            'name' => 'Product Manager',
            'link' => 'https://www.externatic.fr/metiers/product-manager/',
            'category'  => 'category_tech',
        ],

        [
            'name' => 'Ingenieur Test',
            'link' => 'https://www.externatic.fr/metiers/ingenieur-test/',
            'category'  => 'category_tech',
        ],

        [
            'name' => 'DSI – Directeur du Système d’Informations',
            'link' => 'https://www.externatic.fr/metiers/dsi-directeur-du-systeme-dinformation/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Directeur / chef de projet',
            'link' => 'https://www.externatic.fr/metiers/chef-de-projet-web/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Directeur technique / CTO',
            'link' => 'https://www.externatic.fr/metiers/chief-technical-officer-cto/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Responsable de la Sécurité du Système Informatique (RSSI)',
            'link' => 'https://www.externatic.fr/metiers/responsable-de-la-securite-du-systeme-dinformations-rssi/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Directeur Marketing (CMO)',
            'link' => 'https://www.externatic.fr/metiers/directeur-marketing-cmo/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Service Delivery Manager (SDM)',
            'link' => 'https://www.externatic.fr/metiers/service-delivery-manager-sdm/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Customer Success Manager (CSM)',
            'link' => 'https://www.externatic.fr/metiers/customer-success-manager-csm/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Chief Operating Officer (COO)',
            'link' => 'https://www.externatic.fr/metiers/chief-operating-officer-coo/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Business Developper',
            'link' => 'https://www.externatic.fr/metiers/business-developper/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Growth Hacker',
            'link' => 'https://www.externatic.fr/metiers/growth-hacker-2/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Expert SEO – Trafic & content Manager',
            'link' => 'https://www.externatic.fr/metiers/expert-seo-traffic-content-manager/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Chef de projet Web',
            'link' => 'https://www.externatic.fr/metiers/chef-de-projet-web-2/',
            'category'  => 'category_mana',
        ],

        [
            'name' => 'Data Architect',
            'link' => 'https://www.externatic.fr/metiers/data-architect/',
            'category'  => 'category_data',
        ],

        [
            'name' => 'Data Engineer',
            'link' => 'https://www.externatic.fr/metiers/data-engineer/',
            'category'  => 'category_data',
        ],

        [
            'name' => 'Data Analyst',
            'link' => 'https://www.externatic.fr/metiers/data-analyst/',
            'category'  => 'category_data',
        ],

        [
            'name' => 'Data Scientist',
            'link' => 'https://www.externatic.fr/metiers/data-scientist/',
            'category'  => 'category_data',
        ],

        [
            'name' => 'Consultant en recrutement IT',
            'link' => 'https://www.externatic.fr/metiers/consultant-en-recrutement-it/',
            'category'  => 'category_rh',
        ],

        [
            'name' => 'Recruteur tech',
            'link' => 'https://www.externatic.fr/metiers/recruteur-tech/',
            'category'  => 'category_rh',
        ],

        [
            'name' => 'RSSI',
            'link' => 'https://www.underguard.fr/metiers/rssi/',
            'category'  => 'category_cyber',
        ],

        [
            'name' => 'Ingénieur Réseaux & Sécurité',
            'link' => 'https://www.underguard.fr/metiers/ingenieur-reseaux-securite/',
            'category'  => 'category_cyber',
        ],

        [
            'name' => 'Ingénieur SOC',
            'link' => 'https://www.underguard.fr/metiers/ingenieur-soc/',
            'category'  => 'category_cyber',
        ],

        [
            'name' => 'Ingénieur pentester',
            'link' => 'https://www.underguard.fr/metiers/ingenieur-pentester/',
            'category'  => 'category_cyber',
        ],



        ];


    public function load(ObjectManager $manager): void
    {


        foreach (self::JOBS as $jobs) {
            $businessCard = new BusinessCard();
            $businessCard->setName($jobs['name']);
            $businessCard->setLink($jobs['link']);
            $businessCard->setCategory($this->getReference($jobs['category']));
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
