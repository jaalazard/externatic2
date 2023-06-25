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
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::NB_USERS; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_CANDIDATE']);
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'userpassword');
            $user->setPassword($hashedPassword);
            $user->setLastname($faker->lastName());
            $user->setFirstname($faker->firstName());
            $this->addReference('user_' . $i, $user);
            $manager->persist($user);
        }

        $user = new User();
        $user->setEmail('candidate@example.com');
        $user->setRoles(['ROLE_CANDIDATE']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'candidatepassword');
        $user->setPassword($hashedPassword);
        $user->setLastname('Koyékoué');
        $user->setFirstname('Ruben');
        $this->addReference('user_' . 10, $user);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('admin@example.com');
        $user->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'adminpassword');
        $user->setPassword($hashedPassword);
        $user->setLastname('Franco');
        $user->setFirstname('Mathys');
        $this->addReference('user_admin', $user);
        $manager->persist($user);

        $manager->flush();
    }
}
