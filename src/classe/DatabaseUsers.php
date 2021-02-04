<?php

namespace App\classe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;

class DataUsers extends AbstractController
{

    public $nom ;

    public $prenom;

    public $email ;
    
    public $manager ;
         
    public function __construct($nom,$prenom,$email,$manager){

        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->manager= $manager;

    }
 
    public function AddNewUser(){

        $utilisateur = new Utilisateur();

        $utilisateur->setNom($this->nom)
                    ->setPrenom($this->prenom)
                    ->setEmail($this->email)
                    ->setDateCreation(new \DateTime());

                     $this->manager->persist($utilisateur);
                     $this->manager->flush();
    }

    public function getUserById($id)
    {
        return $this->manager->getRepository(Utilisateur::class)->find($id);
    }

    public function UpdateUser($id){

        $utilisateur = $this->getUserById($id);
 
        if (!$utilisateur) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $utilisateur->setNom($this->nom)
                    ->setPrenom($this->prenom)
                    ->setEmail($this->email)
                    ->setDateModification(new \DateTime());
            
                    $this->manager->flush();

    }


}

?>