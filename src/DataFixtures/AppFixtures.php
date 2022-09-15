<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $Users = new Users();
        $Users->setName('Admin');
        $Users->setPassword('12300123');
        $manager->persist($Users);
        $manager->flush();

        $Users = new Users();
        $Users->setName('ano');
        $Users->setPassword('12300123');
        $manager->persist($Users);
        $manager->flush();
    }
}
