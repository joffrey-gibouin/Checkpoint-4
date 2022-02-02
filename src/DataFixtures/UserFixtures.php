<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
         $user = new User();
         $user->setNickname('joffrey');
         $hashedPassword = $this->passwordHasher->hashPassword(
             $user,
             'azerty'
         );
         $user->setPassword($hashedPassword);
         $manager->persist($user);

        $user2 = new User();
        $user2->setNickname('mathilde');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user2,
            'azerty'
        );
        $user2->setPassword($hashedPassword);
        $manager->persist($user2);

        $manager->flush();
    }

}
