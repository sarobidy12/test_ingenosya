<?php

namespace App\classe;
use App\Entity\Utilisateur;

class ListUser  
{
  
    public $connection;

    public $nbrUser;

    public $nbrByPage = 10 ;

    public $pageCourante = 1;
         

    public function __construct($connection){
        $this->connection= $connection;
        $this->totalNbrUSer();
    }

 
    public  function pagination()
    {
        return  ($this->pageCourante - 1 ) * $this->nbrByPage;
    }

    public  function SetPageCourant($page)
    {
        $this->pageCourante = $page;
    }

    public function totalNbrUSer(){
        $sql = "SELECT * FROM Utilisateur";
        $allUser = $this->connection->fetchAllAssociative($sql);
        $this->nbrUser = count($allUser);
    }


    public function All(){

            $sql = "SELECT * FROM Utilisateur LIMIT ".$this->pagination().",".$this->nbrByPage."";
            $users = $this->connection->fetchAllAssociative($sql);
         
            return $users;

   }

   public  function getnbrUser()
   {
       return $this->nbrUser;

   }

}

?>