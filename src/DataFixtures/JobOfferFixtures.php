<?php

namespace App\DataFixtures;

use App\Entity\JobOffer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class JobOfferFixtures extends Fixture implements DependentFixtureInterface
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

    public const CONTRACTS = [
        'Alternance' => 'Alternance',
        'CDD' => 'CDD',
        'CDI' => 'CDI',
    ];

    public const TOWNS = [
        'Paris', 'Lyon', 'Bordeaux', 'Marseille', 'Metz', 'Strasbourg', 'Rennes', 'Nantes', 'Agen', 'Orléans'
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        foreach (self::JOBOFFERS as $jobOfferCard) {
            $jobOffer = new JobOffer();
            $jobOffer->setJob($jobOfferCard['job']);
            $jobOffer->setEntreprise($jobOfferCard['entreprise']);
            $jobOffer->setContract(self::CONTRACTS[array_rand(self::CONTRACTS)]);
            $jobOffer->setDescription($jobOfferCard['description']);
            $jobOffer->setCity(self::TOWNS[rand(0, count(self::TOWNS) - 1)]);
            $jobOffer->setLatitude($faker->latitude(42, 52));
            $jobOffer->setLongitude($faker->longitude(-3, 7));

            $manager->persist($jobOffer);

            $jobOffer->addCandidate($this->getReference('candidate_' .
                $faker->numberBetween(0, UserFixtures::NB_USERS - 1)));
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CandidateFixtures::class,

        ];
    }
}
