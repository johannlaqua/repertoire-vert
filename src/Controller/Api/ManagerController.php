<?php

namespace App\Controller\Api;

use App\Entity\Review;
use App\Entity\User;
use App\Repository\UserRepository;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\User\UserInterface;

class ManagerController extends AbstractController
{

  private $userRepository;

  public function __construct(
    UserRepository $userRepository
  ) {
    $this->userRepository = $userRepository;
  }

  /**
   * @Route("/api/users",name="api_users")
   * @Method({"GET"})
   */
  public function getUsers(SerializerInterface $serializer)
  {
    $users = $this->getDoctrine()->getRepository(User::class)->findAll();
    //$data=$this->get('jms_serializer')->serialize($users,'json');
    //return new JsonResponse(json_decode($data),200);
    $data = $serializer->serialize($users, 'json');
    return new Response($data, 200);
  }

  /**
   * @Route("/api/gaeaUsers/{id}", name="api_user_gaea_id")
   * @Method({"GET"})
   */
  public function getUserByGaeaId($id)
  {
    $em = $this->getDoctrine()->getManager();
    $user = $this->userRepository->findOneByGaeaId($id);
    if (!$user) {
      return new Response(
        "User not found",
        Response::HTTP_NOT_FOUND,
      );
    }

    $serializer = $this->container->get('serializer');
    $userJson = $serializer->serialize($user[0], 'json');

    return new Response(
      $userJson,
      Response::HTTP_OK,
    );
  }

  /**
   * @Route("/api/users/{id}", name="api_user")
   * @Method({"GET"})
   */
  public function selectedUser($id)
    {
        $users=$this->getDoctrine()->getRepository(User::class)->find($id);
        $data=$this->get('jms_serializer')->serialize($users,'json');

        return new JsonResponse(json_decode($data),200);
    }

  /**
   * @Route("/api/getcurrent",name="current_user")
   * @Method({"GET"})
   */
  public function getCurrentUser(SerializerInterface $serializer)
  {

    // $serializer = $this->get('jms_serializer');

    return new Response($serializer->serialize($this->getUser(), "json"));
  }

  /**
   * @Route("/api/getcurrents",name="current_users")
   * @Method({"GET"})
   */
  public function getAction(UserInterface $user)
  {
    if ($user !== $this->getUser()) {
      throw new AccessDeniedHttpException();
    }

    return new JsonResponse($user, 200);
  }
  /**
   * @param Request $request
   * @param $id
   * @Route("/api/users/{id}",name="api_update")
   * @Method({"PUT"})
   * @return JsonResponse
   */
  public function updateUser(Request $request, $id, UserPasswordEncoderInterface $encoder)
  {

    $user = $this->getDoctrine()->getRepository(User::class)->find($id);


    $body = $request->getContent();
    $data = $this->get('jms_serializer')->deserialize($body, User::class, 'json');

    $user->setFirstname($data->getFirstname());
    $user->setLastname($data->getlastname());
    $user->setUsername($data->getUsername());
    $user->setEmail($data->getEmail());
    $user->setPassword($encoder->encodePassword($user, $data->getPassword()));
    $em = $this->getDoctrine()->getManager();
    $em->persist($user);
    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'User updated!',
      'errors' => null,
      'result' => null

    );
    return new JsonResponse($response, 200);
  }

  /**
   * @Route("/api/users/{id}",name="api_delete")
   * @Method({"DELETE"})
   */
  public function deleteUser($id)
  {

    $user = $this->getDoctrine()->getRepository(User::class)->find($id);

    $em = $this->getDoctrine()->getManager();
    $em->remove($user);
    $em->flush();

    $response = array(

      'code' => 0,
      'message' => 'user deleted !',
      'errors' => null,
      'result' => null

    );
    return new JsonResponse($response, 200);
  }



  /**
   * @Route("/api/UpdateUserStatus/{id}",name="update_user_status")
   * @Method({"PUT"})
   */
  public function updateUserStatus($id)
  {

    $user = $this->getDoctrine()->getRepository(User::class)->find($id);
    if ($user->isConnected() == false) {
      $user->setConnected(true);
    } elseif ($user->isConnected() == true) {
      $user->setConnected(false);
    }

    $em = $this->getDoctrine()->getManager();
    $em->persist($user);

    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'User Status Updated!',
      'errors' => null,
      'result' => $user

    );
    return new JsonResponse($response, 200);
  }


  /**
   * @Route("/api/switchToLoggedIn/{id}",name="switch_to_connected")
   * @Method({"PUT"})
   */
  public function switchToConnected($id)
  {

    $user = $this->getDoctrine()->getRepository(User::class)->find($id);
    $user->setConnected(true);




    $em = $this->getDoctrine()->getManager();
    $em->persist($user);

    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'User Status Updated!',
      'errors' => null,
      'result' => $user

    );
    return new JsonResponse($response, 200);
  }

  /**
   * @Route("/api/switchToLoggedOff/{id}",name="switch_to_disconnected")
   * @Method({"PUT"})
   */
  public function switchToDisConnected($id)
  {

    $user = $this->getDoctrine()->getRepository(User::class)->find($id);
    if ($user->isConnected == true) {
      $user->setConnected(false);
    }





    $em = $this->getDoctrine()->getManager();
    $em->persist($user);

    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'User Status Updated!',
      'errors' => null,
      'result' => $user

    );
    return new JsonResponse($response, 200);
  }




  /**
   * @Route("/rest/getConnectedUsers")
   */
  public function getLoggedInUsers()
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $category = $this->getDoctrine()
      ->getRepository(User::class)
      ->createQueryBuilder('p')
      ->select("p")
      ->where('p.connected = true')

      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($category));
    return $response;
  }

  /**
   * @Route("/rest/calculateAvgReviews/{id}")
   */
  public function calculateReviews($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $queryScore = $this->getDoctrine()
      ->getRepository(Review::class);

    $queryAvgScore = $queryScore->createQueryBuilder('g')
      ->select("avg(g.value)")
      ->where('g.owner = :owner')
      ->setParameter('owner', $id)

      ->getQuery();

    $avgScore = $queryAvgScore->getSingleScalarResult();

    $result = ($avgScore);
    $response->setContent(json_encode($result));
    return $response;
  }


  /**
   * @Route("/api/RateUser/{owner}",name="Rate_User")
   * @Method({"POST"})
   */
  public function addCRateUserAction(Request $request, $owner, SerializerInterface $serializer)
  {
    //$user= $this->getUser();
    $body = $request->getContent();
    $em = $this->getDoctrine()->getManager();
    $user = $this->get("security.token_storage")->getToken()->getUser();
    $data = $serializer->deserialize($body, Review::class, 'json');
    $friend = $em->getRepository(User::class)
      ->find($owner);
    $review = new Review();

    // $user = $em->getRepository(User::class)->find($id);
    $review->setValue($data->getValue());
    $review->setCreator($user);
    $review->setOwner($friend);


    $em->persist($review);

    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'Rate created!',
      'errors' => null,
      'result' => $data

    );
    return new JsonResponse($response, 200);
  }
}
