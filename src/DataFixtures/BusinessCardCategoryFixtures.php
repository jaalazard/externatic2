<?php

namespace App\DataFixtures;

use App\Entity\BusinessCardCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BusinessCardCategoryFixtures extends Fixture
{
    public const CATEGORY = [
        [
            'name' => 'Technologies',
        ],

        [
            'name' => 'Management / Marketing',
        ],

        [
            'name' => 'Data'
        ],

        [
            'name' => 'Ressources humaines',
        ],

        [
            'name' => 'Cybersécurité'
        ]
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::CATEGORY as $key => $categories) {
            $businessCardCategory = new BusinessCardCategory();
            $businessCardCategory -> setName($categories['name']);
            $manager->persist($businessCardCategory);
            $this->addReference('category' . $key, $businessCardCategory);
        }

        $manager->flush();
    }
}
