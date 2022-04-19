<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurConnecteController extends AbstractController
{
    //tentative selon instruction alexandre
    // #[Route('/produits/show/{id}', name: 'utilisateur_connecte')]
 
    // public function connecté(EntityManager $em)
    // {

    //     $em = $this->getDoctrine()->getManager() ;
    //     if( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
    //         // authenticated (NON anonymous)
    //         return ;
    //     }else{

    //     }
    // }
}