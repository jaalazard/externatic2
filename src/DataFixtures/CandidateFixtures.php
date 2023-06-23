<?php

namespace App\DataFixtures;

use App\Entity\Candidate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CandidateFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < UserFixtures::NB_USERS; $i++) {
            $candidate = new Candidate();
            $candidate->setAddress($faker->address());
            $candidate->setCity($faker->city());
            $candidate->setUser($this->getReference('user_' . $i));
            $candidate->setCvitae('');
            $this->addReference('candidate_' . $i, $candidate);
            $manager->persist($candidate);
        }

        $candidate = new Candidate();
        $candidate->setAddress('A la maison');
        $candidate->setCity('Orléans');
        $candidate->setUser($this->getReference('user_' . 11));
        $this->addReference('candidate_' . 11, $candidate);
        $manager->persist($candidate);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
