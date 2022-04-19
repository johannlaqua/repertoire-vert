<?php

namespace App\Controller\Api;

use App\Entity\Communauty;
use App\Entity\CovFavorite;
use App\Entity\CovInvitation;
use App\Entity\Notification;
use App\Entity\Participation;
use App\Entity\User;
use App\Repository\CommunautyRepository;
use App\Repository\CovFavoriteRepository;
use App\Repository\CovInvitationRepository;
use App\Repository\NotificationRepository;
use App\Repository\ParticipationRepository;
use App\Repository\UserRepository;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CovoiturageFavoriteController extends AbstractController
{
  private $userRepository;
  private $covoiturageRepository;
  private $favoriteRepository;
  private $invitationRepository;
  private $notificationRepository;

  public function __construct(
    UserRepository $userRepository,
    CommunautyRepository $covoiturageRepository,
    CovFavoriteRepository $favoriteRepository,
    CovInvitationRepository $invitationRepository,
    NotificationRepository $notificationRepository
  ) {
    $this->userRepository = $userRepository;
    $this->covoiturageRepository = $covoiturageRepository;
    $this->favoriteRepository = $favoriteRepository;
    $this->invitationRepository = $invitationRepository;
    $this->notificationRepository = $notificationRepository;
  }


  /**
   * @Route("/api/users/{id}/covFavorites", methods={"GET"})
   */
  public function getUserCovoiturageFavorites($id)
  {
    // Get user
    $user = $this->userRepository->findOneById($id);

    if (!$user) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User not found',
      ));
    }

    // Get user covoiturage favorites
    $favorites = $this->favoriteRepository->findByUser($id);

    // Return favorites
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Covoiturage invitation added successfully",
      'favorites' => $favorites,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/users/{id}/covFavorites", methods={"POST"})
   */
  public function addFavorite(Request $request, $id)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user and friend
    $user = $this->userRepository->findOneById($parameters['user']);
    $favorite_user = $this->userRepository->findOneById($parameters['favorite']);

    if (!$user || !$favorite_user) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User not found',
      ));
    }

    // Create new coivoiturage invitation
    $favorite = new CovFavorite();
    $favorite->setUser($user);
    $favorite->setFavorite($favorite_user);

    // Add favorite to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($favorite);
    $em->flush();

    // Return created favorite
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "Favorite added successfully",
      'favoriteId' => $favorite->getId(),
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/users/{userId}/covFavorites/{favoriteId}", methods={"DELETE"})
   */
  public function deleteFavorite($userId, $favoriteId)
  {
    // Get favorite
    $favorite = $this->favoriteRepository->findOneBy([
      'user' => $userId,
      'favorite' => $favoriteId
    ]);

    // Return error if not found
    if (!$favorite) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Favorite not found'
      ));
    }

    // Remove from DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($favorite);
    $em->flush();

    // Return delete successful
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Favorite deleted successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}
