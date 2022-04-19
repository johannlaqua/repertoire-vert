<?php

namespace App\Controller\Api;




use App\Entity\Discussion;
use App\Entity\User;
use JMS\Serializer\SerializerInterface;
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

class DiscussionController extends AbstractController
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * @Route("/api/sendMessage/{recipient}",name="send_message")
     * @Method({"POST"})
     */
    public function SendMessageAction(Request $request, $recipient,SerializerInterface $serializer)
    {
        //$user= $this->getUser();
        $body = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $user = $this->get("security.token_storage")->getToken()->getUser();
        $data = $serializer->deserialize($body, Discussion::class, 'json');
        $friend = $em->getRepository(User::class)
            ->find($recipient);
        $message = new Discussion();

        // $user = $em->getRepository(User::class)->find($id);
        $message->setMessage($data->getMessage());
        $message->setRecipient($friend);
        $message->setSender($user);
        $message->setSentAt(new \DateTime('now'));
        $message->setSeen(false);


        $em->persist($message);

        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'Message send created!',
            'errors' => null,
            'result' => $data

        );
        return new JsonResponse($response, 200);

    }
    /**
     * @Route("/api/getDiscussionByUser/{id}/{recipient}",name="get_messages_by_user")
     * @Method({"GET"})
     */
    public function GetMessageyUser($id,$recipient)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
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
        $response->setContent(json_encode($messages));
        return $response;
    }
    /**
     * @Route("/api/getMessageByRecipient/{id}",name="getMessageByRecipient")
     * @Method({"GET"})
     */
    public function getSendedMessagebyUser($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $messages = $this->getDoctrine()
            ->getRepository(Discussion::class)
            ->createQueryBuilder('p')
            ->select("p, u")
            ->leftJoin('p.sender', 'u')
            ->where('p.sender = :id')
            ->orderBy('p.sentAt', 'ASC')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($messages));
        return $response;
    }
}