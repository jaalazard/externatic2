<?php

namespace App\DataFixtures;

use App\Entity\JobOffer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobOfferFixtures extends Fixture
{
    public const JOBOFFERS = [
        [
            'job' => 'Data analyst', 'entreprise' => 'Wild code school', 'contract' => 'Alternance', 'city' => 'Nantes',
            'description' => 'Recherche de DATA ANALYST chez NEW-INFO, une grande entreprise d’INFORMATIQUE avec 
            un grand savoir-faire'
        ],
        [
            'job' => 'Développeur web', 'entreprise' => 'Wild code school', 'contract' => 'CDD', 'city' => 'Orléans',
            'description' => 'Développeur Web Full-Stack H/F - Le guide côtier communautaire leader en Europe '
        ],
        [
            'job' => 'Dev Back-end', 'entreprise' => 'Wild code school', 'contract' => 'CDI', 'city' => 'Angers',
            'description' => 'Recherche de DÉVELOPPEUR BACK-END chez BACK’YO, une grande entreprise de DÉVELOPPEUR '
        ],
        [
            'job' => 'Développeur php', 'entreprise' => 'Wild code school', 'contract' => 'CDD', 'city' => 'Olivet',
            'description' => 'Recherche de DÉVELOPPEUR PHP chez INFORMATIK, une grande entreprise SÉRIEUSE avec 
            un grand savoir-faire'
        ],
        [
            'job' => 'Analyst Cybersécurité', 'entreprise' => 'Wild code school', 'contract' => 'CDI',
            'city' => 'Reims', 'description' => 'IT Compliance Project Manager H/F - Cybersécurité, résilience, 
            durabilité, RGPD'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::JOBOFFERS as $jobOfferCard) {
            $jobOffer = new JobOffer();
            $jobOffer->setJob($jobOfferCard['job']);
            $jobOffer->setEntreprise($jobOfferCard['entreprise']);
            $jobOffer->setContract($jobOfferCard['contract']);
            $jobOffer->setCity($jobOfferCard['city']);
            $jobOffer->setDescription($jobOfferCard['description']);
            $manager->persist($jobOffer);
        }
        $manager->flush();
    }
}
