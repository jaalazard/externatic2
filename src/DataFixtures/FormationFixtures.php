<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formation;
use DateTime;

class FormationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $formation = new Formation();
        $formation->setEstablishment('Wild Code School');
        $formation->setDiploma('Développeur Web et web Mobile');
        $formation->setStart(new DateTime('2023/02/28'));
        $formation->setEnd(new DateTime('2023/07/28'));
        $this->addReference('formation_1', $formation);
        $manager->persist($formation);

        $formation = new Formation();
        $formation->setEstablishment('Wild Code School');
        $formation->setDiploma('Concepteur d\'Application Mobile');
        $formation->setStart(new DateTime('2022/10/11'));
        $formation->setEnd(new DateTime('2023/01/19'));
        $this->addReference('formation_2', $formation);
        $manager->persist($formation);

        $manager->flush();
    }
}
