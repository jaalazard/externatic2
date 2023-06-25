<?php

namespace App\DataFixtures;

use App\Entity\Experience;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\DataFixtures\CandidateFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ExperienceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $experience = new Experience();
            $experience->setJobTitle($faker->jobTitle());
            $experience->setCompany($faker->company());
            $experience->setStart($faker->dateTime());
            $experience->setEnd($faker->dateTime());
            $experience->setCandidates($this->getReference(
                'candidate_' . $faker->numberBetween(0, UserFixtures::NB_USERS)
            ));
            $this->addReference('experience_' . $i, $experience);
            $manager->persist($experience);
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
