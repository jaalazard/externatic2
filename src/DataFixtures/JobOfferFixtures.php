<?php

namespace App\DataFixtures;

use App\Entity\JobOffer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobOfferFixtures extends Fixture
{
    public const JOBOFFERS = [
        [
            'job' => 'Data analyst', 'contract' => 'Alternance', 'city' => 'Nantes',
            'description' => 'Recherche de DATA ANALYST chez NEW-INFO, une grande entreprise d’INFORMATIQUE avec 
            un grand savoir-faire'
        ],
        [
            'job' => 'Développeur web', 'contract' => 'CDD', 'city' => 'Orléans',
            'description' => 'Développeur Web Full-Stack H/F - Le guide côtier communautaire leader en Europe '
        ],
        [
            'job' => 'Dev Back-end', 'contract' => 'CDI', 'city' => 'Angers',
            'description' => 'Recherche de DÉVELOPPEUR BACK-END chez BACK’YO, une grande entreprise de DÉVELOPPEUR '
        ],
        [
            'job' => 'Développeur php', 'contract' => 'CDD', 'city' => 'Olivet',
            'description' => 'Recherche de DÉVELOPPEUR PHP chez INFORMATIK, une grande entreprise SÉRIEUSE avec 
            un grand savoir-faire'
        ],
        [
            'job' => 'Analyst Cybersécurité', 'contract' => 'CDI', 'city' => 'Reims',
            'description' => 'IT Compliance Project Manager H/F - Cybersécurité, résilience, durabilité, RGPD'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::JOBOFFERS as $jobOfferCard) {
            $jobOffer = new JobOffer();
            $jobOffer->setJob($jobOfferCard['job']);
            $jobOffer->setContract($jobOfferCard['contract']);
            $jobOffer->setCity($jobOfferCard['city']);
            $jobOffer->setDescription($jobOfferCard['description']);
            $manager->persist($jobOffer);
        }
        $manager->flush();
    }
}
