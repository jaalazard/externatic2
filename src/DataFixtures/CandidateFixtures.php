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

        $candidate = new Candidate();
        $candidate->setAddress($faker->address());
        $candidate->setCity($faker->city());
        $candidate->setUser($this->getReference('user_candidate'));
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
