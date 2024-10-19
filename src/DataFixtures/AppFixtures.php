<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {

    }

    public function load(ObjectManager $manager): void
    {
        $usersData = [
            ['username' => 'admin', 'roles' => ['ROLE_ADMIN'], 'name' => 'Administrador', 'password' => 'admin'],
            ['username' => 'waiter1', 'roles' => ['ROLE_WAITER'], 'name' => 'Garçom 1', 'password' => 'waiter'],
            ['username' => 'waiter2', 'roles' => ['ROLE_WAITER'], 'name' => 'Garçom 2', 'password' => 'waiter'],
            ['username' => 'chef', 'roles' => ['ROLE_CHEF'], 'name' => 'Chef', 'password' => 'chef'],
        ];

        foreach ($usersData as $userData) {
            $user = new User();

            $user->setUsername($userData['username']);
            $user->setRoles($userData['roles']);
            $user->setName($userData['name']);
            $hashedPassword = $this->userPasswordHasher->hashPassword($user, $userData['password']);
            $user->setPassword($hashedPassword);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
