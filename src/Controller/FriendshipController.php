<?php

namespace App\Controller;

use App\Entity\Friendship;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Person;
use App\Form\PersonType;
use Cocur\Slugify\Slugify;

class FriendshipController extends AbstractController
{
    public function AfficheAction()
    {
        $friendId=0;
        $userId=0;
        $em = $this->getDoctrine()->getManager();
        $users = $this->getDoctrine()
            ->getRepository(User::class)->findAll();

        $friends = $this->getDoctrine()
            ->getRepository(Friendship::class)->findAll();

        $List = [];
        foreach($friends as $Key=>$Arr){
            $List = $Arr->getFriend()->getId(); // your loop record was replacing in every loop. now will be captured in array.
     //  print_r($List);
        }
        $userss = [];
        foreach($friends as $Key=>$Arr){
            $userss = $Arr->getUser()->getId(); // your loop record was replacing in every loop. now will be captured in array.
            print_r($userss);
        }
        /*
        foreach($friends as $event)
        {

            $friendId = ($event->getFriend()->getId());
            $userId = ($event->getUser()->getId());
           // print_r($friendId);
            //print_r($userId);
        }
*/

        return $this->render('social/users.html.twig', array("users" => $users,
            "friends"=>$friends,
            "friendId"=>$friendId,
            "userId"=>$userId,
            "userss"=>$userss,
            "List"=>$List));

    }
    public function DisplayFriendsAction()
    {
        $isAccepted=true;
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $MyFriends = $em->getRepository(Friendship::class)
            ->createQueryBuilder('q')
            ->select("q, c, u")
            ->where('q.friend = :id')
            ->andWhere('q.isAccepted=:isAccepted')
            ->leftJoin('q.user', 'u')
            ->leftJoin('q.friend', 'c')
            ->setParameters(array('id'=> $id, 'isAccepted' => $isAccepted))
            ->getQuery()
            ->getArrayResult();

        $MyFriendss = $em->getRepository(Friendship::class)
            ->createQueryBuilder('q')
            ->select("q, c, u")
            ->where('q.user = :id')
            ->andWhere('q.isAccepted=:isAccepted')
            ->leftJoin('q.user', 'u')
            ->leftJoin('q.friend', 'c')
            ->setParameters(array('id'=> $id, 'isAccepted' => $isAccepted))
            ->getQuery()
            ->getArrayResult();

        return $this->render('social/FriendsList.html.twig', array("MyFriends" => $MyFriends,
            "MyFriendss"=>$MyFriendss));


    }

    public function getFriendRequests()
    {
$isAccepted=false;
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $friendsRequests=$this->getDoctrine()
            ->getRepository(Friendship::class)
            ->createQueryBuilder('p')
            ->select("p")
            ->where('p.friend = :id')
            ->andWhere('p.isAccepted=:isAccepted')
            ->setParameters(array('id'=> $id, 'isAccepted' => $isAccepted))
            ->getQuery()
            ->getResult();


        return $this->render('social/FriendsRequests.html.twig', array("friendsRequests" => $friendsRequests));


    }
    public function sendFriendRequest(Request $request, $id)
    {

        $ref = $request->headers->get('referer');
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $user = $this->getUser();
        $friend = $em
            ->getRepository(User::class)
            ->find($id);
        $friendship = new Friendship();
        // $user = $em->getRepository(User::class)->find($id);
        $friendship->setUser($user);
        $friendship->setFriend($friend);
        $friendship->setIsAccepted(false);

        $em->persist($friendship);
        $em->flush();
        $this->addFlash(
            'danger', 'Invitation envoyé !.'
        );
        return $this->redirect($ref);

    }




    public function AcceptFriendRequestAction($id){


        $friendship=$this->getDoctrine()->getRepository(Friendship::class)->find($id);
        $friendship->setIsAccepted(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($friendship);
        $em->flush();
            return $this->redirectToRoute('displayFriendsRequests');

    }


}
