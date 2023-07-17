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
            un grand savoir-faire',
            'synopsis' => 'A ce titre, vos missions sont les suivantes :
            Identification des sources de données pertinentes et les mettre en relation
            Modélisation et mise à jour des bases de donnéesÉlaboration et adaptation des outils de reporting,
             d\'analyse et des indicateurs clés de pilotage
            Identification, mesure et analysé des écarts sous forme de statistiques, de tableaux de bord et 
            de rapports d\'activité
            Reporting mensuel et suivi de budget', 'profil' => 'Vous justifiez d\'une expérience d\'au moins
             3 années dans la gestion de données (financières, administratives, comptables, de production,
              sociale, environnementale).
            Vous maîtrisez les outils informatiques suivants : Excel, Power BI. Oracle Netsuite BI/SQL 
            est un plus.
            Anglais courant impératif.',
        ],
        [
            'job' => 'Développeur web', 'entreprise' => 'Wild code school', 'contract' => 'CDD', 'city' => 'Orléans',
            'description' => 'Développeur Web Full-Stack H/F - Le guide côtier communautaire leader en Europe ',
            'synopsis' => 'A ce titre, vos missions sont les suivantes :
            Identification des sources de données pertinentes et les mettre en relation
            Modélisation et mise à jour des bases de donnéesÉlaboration et adaptation des outils
             de reporting, d\'analyse et des indicateurs clés de pilotage
            Identification, mesure et analysé des écarts sous forme de statistiques, de tableaux
             de bord et de rapports d\'activité
            Reporting mensuel et suivi de budget', 'profil' => 'Vous justifiez d\'une expérience
             d\'au moins 3 années dans la gestion de données (financières, administratives,
              comptables, de production,
              sociale, environnementale).
            Vous maîtrisez les outils informatiques suivants : Excel, Power BI. Oracle Netsuite 
            BI/SQL est un plus.
            Anglais courant impératif.',
        ],
        [
            'job' => 'Dev Back-end', 'entreprise' => 'Wild code school', 'contract' => 'CDI', 'city' => 'Angers',
            'description' => 'Recherche de DÉVELOPPEUR BACK-END chez BACK’YO, une grande entreprise de DÉVELOPPEUR ',
            'synopsis' => 'A ce titre, vos missions sont les suivantes :
            Identification des sources de données pertinentes et les mettre en relation
            Modélisation et mise à jour des bases de donnéesÉlaboration et adaptation des outils
             de reporting, d\'analyse et des indicateurs clés de pilotage
            Identification, mesure et analysé des écarts sous forme de statistiques, de tableaux
             de bord et de rapports d\'activité
            Reporting mensuel et suivi de budget', 'profil' => 'Vous justifiez d\'une expérience
             d\'au moins 3 années dans la gestion de données (financières, administratives, comptables,
              de production, sociale, environnementale).
            Vous maîtrisez les outils informatiques suivants : Excel, Power BI. Oracle Netsuite BI/SQL
             est un plus.
            Anglais courant impératif.',
        ],
        [
            'job' => 'Développeur php', 'entreprise' => 'Wild code school', 'contract' => 'CDD', 'city' => 'Olivet',
            'description' => 'Recherche de DÉVELOPPEUR PHP chez INFORMATIK, une grande entreprise SÉRIEUSE avec 
            un grand savoir-faire',
            'synopsis' => 'A ce titre, vos missions sont les suivantes :
            Identification des sources de données pertinentes et les mettre en relation
            Modélisation et mise à jour des bases de donnéesÉlaboration et adaptation des outils
             de reporting, d\'analyse et des indicateurs clés de pilotage
            Identification, mesure et analysé des écarts sous forme de statistiques, de tableaux
             de bord et de rapports d\'activité
            Reporting mensuel et suivi de budget', 'profil' => 'Vous justifiez d\'une expérience
            d\'au moins 3 années dans la gestion de données (financières, administratives, comptables,
             de production, sociale, environnementale).
            Vous maîtrisez les outils informatiques suivants : Excel, Power BI. Oracle Netsuite BI/SQL 
            est un plus.
            Anglais courant impératif.',
        ],
        [
            'job' => 'Analyst Cybersécurité', 'entreprise' => 'Wild code school', 'contract' => 'CDI',
            'city' => 'Reims', 'description' => 'IT Compliance Project Manager H/F - Cybersécurité, résilience, 
            durabilité, RGPD', 'synopsis' => 'A ce titre, vos missions sont les suivantes :
            Identification des sources de données pertinentes et les mettre en relation
            Modélisation et mise à jour des bases de donnéesÉlaboration et adaptation des outils
             de reporting, d\'analyse et des indicateurs clés de pilotage
            Identification, mesure et analysé des écarts sous forme de statistiques, de tableaux
             de bord et de rapports d\'activité
            Reporting mensuel et suivi de budget', 'profil' => 'Vous justifiez d\'une expérience
             d\'au moins 3 années dans la gestion de données (financières, administratives, comptables,
              de production, sociale, environnementale).
            Vous maîtrisez les outils informatiques suivants : Excel, Power BI. Oracle Netsuite
             BI/SQL est un plus.
            Anglais courant impératif.',
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
        for ($i = 0; $i < 10; $i++) {
            foreach (self::JOBOFFERS as $jobOfferCard) {
                $jobOffer = new JobOffer();
                $jobOffer->setJob($jobOfferCard['job']);
                $jobOffer->setEntreprise($jobOfferCard['entreprise']);
                $jobOffer->setContract(self::CONTRACTS[array_rand(self::CONTRACTS)]);
                $jobOffer->setDescription($jobOfferCard['description']);
                $jobOffer->setCity(self::TOWNS[rand(0, count(self::TOWNS) - 1)]);
                $jobOffer->setLatitude($faker->latitude(42.6, 49.8));
                $jobOffer->setLongitude($faker->longitude(-2.6, 7));
                $jobOffer->setProfil($jobOfferCard['profil']);
                $jobOffer->setSynopsis($jobOfferCard['synopsis']);
                $manager->persist($jobOffer);

                $jobOffer->addCandidate($this->getReference('candidate_' .
                    $faker->numberBetween(0, UserFixtures::NB_USERS - 1)));
            }
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            CandidateFixtures::class,

        ];
    }
}
