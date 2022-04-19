<?php

namespace App\Controller\Api;

use App\Entity\Notification;
use App\Entity\User;
use App\Repository\NotificationRepository;
use App\Repository\UserRepository;
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


class NotificationController extends AbstractController
{
  private $userRepository;
  private $notificationRepository;

  public function __construct(
    UserRepository $userRepository,
    NotificationRepository $notificationRepository
  ) {
    $this->userRepository = $userRepository;
    $this->notificationRepository = $notificationRepository;
  }


  /**
   * @Route("/api/users/{userId}/notifications", methods={"GET"})
   */
  public function getUserNotifications($userId)
  {
    // Get user
    $user = $this->userRepository->findOneById($userId);

    if (!$user) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User not found',
      ));
    }

    // Get user notifications
    $notifications = $this->notificationRepository->findByUserId($userId);

    // Return favorites
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Notifications fetched successfully",
      'notifications' => $notifications,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/users/{id}/notifications", methods={"PUT"})
   */
  public function updateNotificationStatus($id)
  {
    $notifications = $this->notificationRepository->findBy(['owner' => $id]);

    foreach ($notifications as $n) {
      // For each notification, set opened to true
      $n->setOpened(true);
      $em = $this->getDoctrine()->getManager();
      $em->persist($n);
    }

    // Save changes to DB
    $em->flush();

    // Return OK
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Notifications updated successfully"
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}
