<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Utilisateur;

class UtilisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i=0;$i < 40;$i++){
            $utilisateur = new Utilisateur();

            $utilisateur->setNom("nom $i")
                        ->setPrenom("prenom $i")
                        ->setEmail("email$i@email.com")
                        ->setDateCreation(new DateTime());
        }

        $manager->flush();
    }
}