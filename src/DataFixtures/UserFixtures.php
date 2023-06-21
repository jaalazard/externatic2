<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public const NB_USERS = 10;

    public function load(ObjectManager $manager): void
    {

        $candidate = new User();
        $candidate->setEmail('candidate@example.com');
        $candidate->setRoles(['ROLE_CANDIDATE']);
        $hashedPassword = $this->passwordHasher->hashPassword($candidate, 'candidatepassword');
        $candidate->setPassword($hashedPassword);
        $this->addReference('user_', $candidate);
        $manager->persist($candidate);

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::NB_USERS; $i++) {
            $candidate = new User();
            $candidate->setEmail($faker->email());
            $candidate->setRoles(['ROLE_CANDIDATE']);
            $hashedPassword = $this->passwordHasher->hashPassword($candidate, 'candidatepassword');
            $candidate->setPassword($hashedPassword);
            $this->addReference('user_' . $i, $candidate);
            $manager->persist($candidate);
        }

        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'adminpassword');
        $admin->setPassword($hashedPassword);
        $this->addReference('user_admin', $admin);
        $manager->persist($admin);

        $manager->flush();
    }
}
