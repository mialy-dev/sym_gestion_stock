<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $utilisateur = new Utilisateur();
        $utilisateur->setUsername('Administrateur');
        $utilisateur->setRoles(array('SUPER_USER'));
        $motdepasse = '$2y$13$5xMEKgjcpPr0YZzZ6OplROCxhSOQKjLZ8Y6qpuOCApsE3j5NW9lWO';
        $utilisateur->setPassword($motdepasse);
        $manager->persist($utilisateur);
        $manager->flush();
    }
}
