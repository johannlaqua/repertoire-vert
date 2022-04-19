<?php

namespace App\Controller\Api;

use App\Entity\ActivitiesDisplay;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ActivitiesDisplayController extends AbstractController
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }



    /**
     * @Route("/api/getActivitiesDisplay/{id}",name="getActivity_Display")
     * @Method({"GET"})
     */
    public function getActivityDisplayByUser($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $activitiesDisplay = $this->getDoctrine()
            ->getRepository(ActivitiesDisplay::class)
            ->createQueryBuilder('p')
            ->select("p")
            ->where('p.owner = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($activitiesDisplay));
        return $response;
    }

    /**
     * @Route("/api/updateActivityDisplayStatus/{id}",name="update_activity_status")
     * @Method({"PUT"})
     */
    public function UpdateNotificationStatus($id,Request $request)
    {
        $notification=$this->getDoctrine()->getRepository(ActivitiesDisplay::class)->find($id);
if($notification->isDisplay()==true){
    $notification->setDisplay(false);
}elseif ($notification->isDisplay()==false){
    $notification->setDisplay(true);
}

        $em = $this->getDoctrine()->getManager();
        $em->persist($notification);
        $em->flush();

        $response=array(
            'code'=>0,
            'message'=>'Notification status updated!',
            'errors'=>null,
            'result'=>null

        );
        return new JsonResponse($response,200);
    }
}