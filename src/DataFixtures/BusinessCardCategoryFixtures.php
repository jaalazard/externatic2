<?php

namespace App\DataFixtures;

use App\Entity\BusinessCardCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BusinessCardCategoryFixtures extends Fixture
{
    public const CATEGORY = [
        [
            'name' => 'Technologies', 'code' => 'tech'
        ],
        [
            'name' => 'Management / Marketing', 'code' => 'mana'
        ],
        [
            'name' => 'Data', 'code' => 'data'
        ],
        [
            'name' => 'Ressouces humaines', 'code' => 'rh'
        ],
        [
            'name' => 'Cybersécurité', 'code' => 'cyber'
        ],
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::CATEGORY as $category) {
            $businessCardCategory = new BusinessCardCategory();
            $businessCardCategory -> setName($category['name']);
            $manager->persist($businessCardCategory);
            $this->addReference('category_' . $category['code'], $businessCardCategory);
        }

        $manager->flush();
    }
}
