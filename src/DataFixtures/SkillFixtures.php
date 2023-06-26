<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SkillFixtures extends Fixture
{
    public const SKILLS_LIST = [
        'PHP',
        'JavaScript',
        'Java',
        'MySQL',
        'HTML',
        'CSS',
        'Bootstrap',
        'Chat GPT',
        'Algorithmes',
        'Beau gosse',
        'Jaikri superre bian',
        'Excellent cuisinier'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SKILLS_LIST as $key => $skillList) {
            $skill = new Skill();
            $skill->setName($skillList);
            $this->addReference('skill_' . $key, $skill);
            $manager->persist($skill);
        }
        $manager->flush();
    }
}
