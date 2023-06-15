<?php

namespace App\DataFixtures;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $candidate = new User();
        $candidate->setEmail('candidate@example.com');
        $candidate->setRoles(['ROLE_CANDIDATE']);
        $hashedPassword = $this->passwordHasher->hashPassword($candidate, 'candidatepassword');
        $candidate->setPassword($hashedPassword);
        $this->addReference('user_candidate', $candidate);
        $manager->persist($candidate);

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
