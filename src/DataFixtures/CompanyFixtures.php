<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Company;

class CompanyFixtures extends Fixture
{
    public const NB_COMPANY = 10;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::NB_COMPANY; $i++) {
            $consultant = new Company();
            $consultant->setName($faker->company());
            $consultant->setLink('https://www.magasins-u.com/accueil');
            $manager->persist($consultant);
        }

        $manager->flush();
    }
}
