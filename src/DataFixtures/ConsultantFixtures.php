<?php

namespace App\DataFixtures;

use App\Entity\Consultant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ConsultantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $consultant = new Consultant();
            $consultant->setLastname($faker->lastName());
            $consultant->setFirstname($faker->firstNameMale());
            $consultant->setLocation($faker->city());
            $consultant->setSpecialization($faker->jobTitle());
            $consultant->setLinkedin('https://www.linkedin.com/in/john-doe-9862301a3/');
            $manager->persist($consultant);
        }

        $manager->flush();
    }
}
