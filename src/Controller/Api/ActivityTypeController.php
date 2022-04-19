<?php

namespace App\Controller\Api;

use App\Repository\ActivityTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class ActivityTypeController extends AbstractController
{


  private $activityTypeRepository;

  public function __construct(
    ActivityTypeRepository $activityTypeRepository) {
    $this->activityTypeRepository = $activityTypeRepository;
  }

  /**
   * @Route("/api/activityTypes", methods={"GET"})
   */
  public function getAll()
  {
    // Get all activity types
    $activityTypes = $this->activityTypeRepository->findAll();
    
    // Return activty types
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Transports fetched successfully",
      'activityTypes' => $activityTypes,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}
