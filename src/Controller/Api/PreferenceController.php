<?php

namespace App\Controller\Api;

use App\Entity\UserPreference;
use App\Repository\PreferenceRepository;
use App\Repository\UserPreferenceRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PreferenceController extends AbstractController
{


  private $preferenceRepository;
  private $userRepository;
  private $userPreferenceRepository;

  public function __construct(
    PreferenceRepository $preferenceRepository,
    UserRepository $userRepository,
    UserPreferenceRepository $userPreferenceRepository) {
    $this->preferenceRepository = $preferenceRepository;
    $this->userRepository = $userRepository;
    $this->userPreferenceRepository = $userPreferenceRepository;
  }

  /**
   * @Route("/api/preferences", methods={"GET"})
   */
  public function getAll()
  {
    // Get all preferences
    $preferences = $this->preferenceRepository->findAll();
    
    // Return preferences
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Preferences fetched successfully",
      'preferences' => $preferences,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/users/{userId}/preferences", methods={"GET"})
   */
  public function getUserPreferences($userId)
  {
    // Get user
    $user = $this->userRepository->findOneById($userId);

    // Return error if user not found
    if (!$user) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User or preference not found',
      ));
    }

    // Get user preferences
    $preferences = $this->userPreferenceRepository->findUserPreferences($userId);
    
    // Return preferences
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Preferences fetched successfully",
      'preferences' => $preferences,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/users/{userId}/preferences", methods={"POST"})
   */
  public function addUserPreference($userId, Request $request)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user
    $user = $this->userRepository->findOneById($userId);

    // Get preference
    $preference = $this->preferenceRepository->findOneBy(['id' => $parameters['preference']]);

    // Return error if user or preference not found
    if (!$user || !$preference) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User or preference not found',
      ));
    }

    // Create new user preference
    $userPreference = new UserPreference();
    $userPreference->setUser($user);
    $userPreference->setPreference($preference);

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($userPreference);
    $em->flush();
    
    // Return preference
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "User Preference added successfully",
      'preference' => $userPreference,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/userPreferences/{preferenceId}", methods={"DELETE"})
   */
  public function deleteUserPreference($preferenceId)
  {
    // Get user preference
    $userPreference = $this->userPreferenceRepository->findOneById($preferenceId);

    // Return error if preference not found
    if (!$userPreference) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User preference not found',
      ));
    }

    // Remove from DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($userPreference);
    $em->flush();
    
    // Return delete message
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "User Preference deleted successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}
