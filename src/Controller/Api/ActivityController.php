<?php

namespace App\Controller\Api;

use App\Entity\Activity;
use App\Entity\ActivityPosition;
use App\Entity\ActivityTransport;
use App\Entity\ActivityType;
use App\Repository\ActivityRepository;
use App\Repository\ActivityTypeRepository;
use App\Repository\TransportRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ActivityController extends AbstractController
{

  private $logger;
  private $activityRepository;
  private $activityTypeRepository;
  private $userRepository;
  private $transportRepository;

  public function __construct(
    LoggerInterface $logger,
    ActivityRepository $activityRepository,
    ActivityTypeRepository $activityTypeRepository,
    UserRepository $userRepository,
    TransportRepository $transportRepository) {
    $this->logger = $logger;
    $this->activityRepository = $activityRepository;
    $this->activityTypeRepository = $activityTypeRepository;
    $this->userRepository = $userRepository;
    $this->transportRepository = $transportRepository;
  }

  /**
   * @Route("/api/activities", methods={"GET"})
   */
  public function getAll()
  {
    // Get all activities
    $activities = $this->activityRepository->findAll();
    
    // Return activties
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Transports fetched successfully",
      'activities' => $activities,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/users/{userId}/activities", methods={"GET"})
   */
  public function getUserActivities($userId)
  {
    // Get user
    $user = $this->userRepository->findOneById($userId);

    // Return error if user not found
    if (!$user) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User not found',
      ));
    }

    // Get all activities
    $activities = $this->activityRepository->findByUser($userId);
    
    // Return activties
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Activities fetched successfully",
      'activities' => $activities,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/activities", methods={"POST"})
   */
  public function addActivity(Request $request)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user and transport
    $user = $this->userRepository->findOneById($parameters['user']);
    $transport = $this->transportRepository->findOneBy(['id' => $parameters['transport']]);

    // Get activity type
    $activityType = null;

    // Get activity type, if selected exists 
    if (isset($parameters['activityTypeId'])) {
      $this->logger->info($parameters['activityTypeId']);
      $activityType = $this->activityTypeRepository->findOneBy(['id' => $parameters['activityTypeId']]);
    }

    // DB manager
    $em = $this->getDoctrine()->getManager();

    // Create new activity type, if selected does not exist
    if (isset($parameters['activityTypeName'])) {

      // Check if activity type with same name exists
      $activityType = $this->activityTypeRepository->findOneBy([
        'name' => strtolower($parameters['activityTypeName'])
      ]);

      if (!$activityType) {
        $activityType =  new ActivityType();
        $activityType->setName(strtolower($parameters['activityTypeName']));
        $activityType->setApproved(false);

        $em->persist($activityType);
      }
    }

    // Return error if user, transport or activiy not found
    if (!$user || !$transport || !$activityType) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User, Activity Type or Transport not found',
      ));
    }

    // Create new activity
    $activity = new Activity();
    $activity->setUser($user);
    $activity->setActivityType($activityType);
    $activity->setSteps(0);
    $activity->setCalories(0);
    $activity->setTotalC02(0);
    $activity->setStatus('Current');
    $activity->setCreatedAt(new \DateTime());
    
    // Save to DB
    $em->persist($activity);
    $em->flush();
    
    // Return activty
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "Activity added successfully",
      'activity' => $activity
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/activities/{activityId}", methods={"DELETE"})
   */
  public function deleteActivity($activityId)
  {
    // Get user
    $activity = $this->activityRepository->findOneBy(['id' => $activityId]);

    // Return error if user not found
    if (!$activity) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Activity not found',
      ));
    }

    // Remove activity from DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($activity);
    $em->flush();
    
    // Return activties
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Activity deleted successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/activities/{activityId}", methods={"PUT"})
   */
  public function updateActivity(Request $request, $activityId)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get activity
    $activity = $this->activityRepository->findOneBy(['id' => $activityId]);

    // Return error if user not found
    if (!$activity) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Activity not found',
      ));
    }

    // Update activity
    $activity->setDateTimeStart(new \DateTime($parameters['dateTimeStart']));
    $activity->setDateTimeEnd(new \DateTime($parameters['dateTimeEnd']));
    $activity->setLatStart($parameters['latStart']);
    $activity->setLonStart($parameters['lonStart']);
    $activity->setLatEnd($parameters['latEnd']);
    $activity->setLonEnd($parameters['lonEnd']);
    $activity->setSteps($parameters['steps']);
    $activity->setCalories($parameters['calories']);
    $activity->setStatus('Done');
    $activity->setTotalC02($parameters['totalC02']);
    $activity->setTotalDistance($parameters['totalDistance']);

    // DB Manager
    $em = $this->getDoctrine()->getManager();

    // Add activity transports
    foreach ($parameters['activityTransports'] as $t) {

      $transportObject = $t['transport'];
      $transportId = $transportObject['id'];

      // Get transport
      $transport = $this->transportRepository->findOneBy(['id' => $transportId]);

      // Create new activityTransport
      $activityTransport = new ActivityTransport();
      $activityTransport->setActivity($activity);
      $activityTransport->setTransport($transport);
      $activityTransport->setC02Emissions($t['c02Emissions']);
      $activityTransport->setDistance($t['distance']);

      // Save activityTransport
      $em->persist($activityTransport);
    }

    // Add activity positions
    foreach ($parameters['activityPositions'] as $p) {

      // Create new activityPosition
      $activityPosition = new ActivityPosition();
      $activityPosition->setActivity($activity);
      $activityPosition->setLatitude($p['latitude']);
      $activityPosition->setLongitude($p['longitude']);
      $activityPosition->setCreatedAt(new \DateTime($p['createdAt']));

      // Save activityPosition
      $em->persist($activityPosition);
    }

    // Update DB
    $em->persist($activity);
    $em->flush();

    // Return 200
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Activity updated successfully"
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}
