<?php

namespace App\Controller\Api;

use App\Entity\Friendship;
use App\Entity\User;
use App\Repository\FriendshipRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class FriendshipController extends AbstractController
{
  private $session;
  private $userRepository;
  private $friendshipRepository;

  public function __construct(
    UserRepository $userRepository, FriendshipRepository $friendshipRepository)
  {
    $this->session = new Session();
    $this->userRepository = $userRepository;
    $this->friendshipRepository = $friendshipRepository;
  }

  /**
   * @Route("/api/friendRequests", name="api_friend_request")
   * @Method({"POST"})
   */
  public function addFriend(Request $request)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get users
    $user = $this->userRepository->findOneById($parameters['user']);
    $friend = $this->userRepository->findOneById($parameters['friend']);

    // Create friendship
    $friendship = new Friendship();
    $friendship->setUser($user);
    $friendship->setFriend($friend);
    $friendship->setIsAccepted(false);

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($friendship);
    $em->flush();

    return new JsonResponse(array(
      'code' => Response::HTTP_CREATED,
      'message' => 'Friend request sent successfully',
      'friendship_id' => $friendship->getId()
    ));
  }


  /**
   * @Route("/api/users/{id}/friendships")
   * @Method({"GET"})
   */
  public function getFriendships($id)
  {
    // Get user friendships
    $friendships = $this->friendshipRepository->findUserFriendships($id);

    $serializer = $this->container->get('serializer');
    $friendshipsJson = $serializer->serialize($friendships, 'json');

    return new Response($friendshipsJson, Response::HTTP_OK);
  }


   /**
   * @Route("/api/friendships/{friendshipId}", methods={"DELETE"})
   */
  public function deleteFriendRequest($friendshipId)
  {
    $friendship = $this->friendshipRepository->findOneById($friendshipId);

    // Update DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($friendship);
    $em->flush();

    return new JsonResponse(array(
      'code' => Response::HTTP_OK,
      'message' => 'Friend request deleted successfully',
    ));
  }


  /**
   * @Route("/api/friendships/{friendshipId}", methods={"PUT"})
   */
  public function acceptFriendRequest($friendshipId)
  {
    $friendship = $this->friendshipRepository->findOneById($friendshipId);
    $friendship->setIsAccepted(true);

    // Update DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($friendship);
    $em->flush();

    return new JsonResponse(array(
      'code' => Response::HTTP_OK,
      'message' => 'Friend request accepted successfully',
    ));
  }
}
