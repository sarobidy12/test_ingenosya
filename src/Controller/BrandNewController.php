<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request; 
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;

use App\classe\DataUsers;
use App\classe\ListUser;


class BrandNewController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    
    public function index( UtilisateurRepository $repository , Request $request  ): Response
    {
        
            $listUser = new ListUser($this->getDoctrine()->getConnection());

            $groupepage= ceil($listUser->nbrUser/$listUser->nbrByPage);

            return $this->render('brand_new/index.html.twig', [
                    'utilisateur' => $listUser->All(),
                    'groupepage'=> $groupepage*1,
                'page'=> 1

            ]);

    }

    /**
     * @Route("/add", name="add")
     */

    public function add( Request $request  ): Response
    {

        $insert= new DataUsers($request->request->get('nom'),$request->request->get('Prenom'),$request->request->get('email'), $this->getDoctrine()->getManager());
      
        $insert->AddNewUser();

        $listUser = new ListUser($this->getDoctrine()->getConnection());
         
        return $this->render('brand_new/index.html.twig', [
            'utilisateur' =>$listUser->All()
        ]);
        
    }


    /**
     * @Route("/update", name="update")
     */

    public function update( Request $request  ): Response
    {
        
        $update = new DataUsers($request->request->get('nom'),$request->request->get('Prenom'),$request->request->get('email'), $this->getDoctrine()->getManager());
       
        $update->UpdateUser($request->request->get('id'));

        $listUser = new ListUser($this->getDoctrine()->getConnection());
         
        return $this->render('brand_new/index.html.twig', [
            'utilisateur' =>$listUser->All()
        ]);
    }

    
    

    /**
     * @Route("/find", name="find")
     */

    public function find( Request $request  ): Response
    {
        
        $connection = $this->getDoctrine()->getConnection();

        $sql = "SELECT * FROM Utilisateur  WHERE nom LIKE '%". $request->request->get('find') ."%' LIMIT 1 ";

        $allUser = $connection->fetchAllAssociative( $sql);

                return $this->render('brand_new/index.html.twig', [
                    'utilisateur' => $allUser,
                    'find'=>$request->request->get('find')
                ]);
    }

    /**
     * @Route("/page/{page}", name="page")
     */

    public function page($page): Response

    {
        $listUser = new ListUser($this->getDoctrine()->getConnection());
        $listUser->SetPageCourant($page);

        $groupepage= ceil($listUser->nbrUser/$listUser->nbrByPage);

        return $this->render('brand_new/index.html.twig', [
                'utilisateur' => $listUser->All(),
                'groupepage'=> $groupepage*1,
                'page'=> $page
        ]);

    }

}
