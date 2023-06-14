<?php

namespace App\DataFixtures;

use App\Entity\Candidate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CandidateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $candidate = new Candidate();
        $candidate->setAddress($faker->address());
        $candidate->setCity($faker->city());
        $manager->persist($candidate);


        $manager->flush();
    }
}
