<?php

namespace App\Controller;

use App\Entity\Friendship;
use App\Entity\User;
use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Person;
use App\Form\PersonType;
use Cocur\Slugify\Slugify;
use App\Entity\Discussion;

class DiscussionController extends AbstractController
{

    public function SendMessageAction(Request $request, $id)
    {
        //$user= $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $friend = $em->getRepository(User::class)
            ->find($id);
        $recipient = $em->getRepository(User::class)
            ->find($id);
$id=$this->getUser()->getId();
        $messages = $this->getDoctrine()
            ->getRepository(Discussion::class)
            ->createQueryBuilder('p')
            ->select("p, c, u")
            ->leftJoin('p.recipient', 'c')
            ->leftJoin('p.sender', 'u')
            ->where('p.sender = :id')
            ->andWhere('p.recipient = :recipient')
            ->orderBy('p.sentAt', 'ASC')
            ->setParameters(array('id'=> $id, 'recipient' => $recipient))
            ->getQuery()
            ->getArrayResult();

        $messagesToMe=$this->GetMessageyUser($recipient);
        $message = new Discussion();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $user = $em->getRepository(User::class)->find($id);
            $message->setRecipient($friend);
            $message->setSender($user);
            $message->setSentAt(new \DateTime('now'));
            $message->setSeen(false);


            $em->persist($message);

            $em->flush();


        }
        return $this->render('social/chat.html.twig', array(
            "Form" => $form->createView(),
            "messages"=>$messages,
            "messagesToMe"=>$messagesToMe
        ));
    }
    public function GetMessageyUser($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sender = $em->getRepository(User::class)
            ->find($id);
        $user=$this->getUser()->getId();
        $messagestoMe = $this->getDoctrine()
            ->getRepository(Discussion::class)
            ->createQueryBuilder('p')
            ->select("p, c, u")
            ->leftJoin('p.recipient', 'c')
            ->leftJoin('p.sender', 'u')
            ->where('p.recipient = :user')
            ->andWhere('p.sender = :sender')
            ->orderBy('p.sentAt', 'ASC')
            ->setParameter( 'user', $user)
            ->setParameters(array('user'=> $user, 'sender' => $sender))
            ->getQuery()
            ->getArrayResult();
       return $messagestoMe;
    }
}
