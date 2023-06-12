<?php

namespace App\DataFixtures;

use App\Entity\Consultant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConsultantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $consultant = new Consultant();
        $consultant->setLastname('Doe');
        $consultant->setFirstname('John');
        $consultant->setLocation('Orléans');
        $consultant->setSpecialization('DataAnalyst');
        $consultant->setLinkedin('https://www.linkedin.com/in/john-doe-9862301a3/');
        $manager->persist($consultant);

        $manager->flush();
    }
}
