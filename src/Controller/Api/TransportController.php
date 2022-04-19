<?php

namespace App\Controller\Api;

use App\Repository\TransportRepository;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class TransportController extends AbstractController
{


  private $transportRepository;

  public function __construct(
    TransportRepository $transportRepository) {
    $this->transportRepository = $transportRepository;
  }

  /**
   * @Route("/api/transports")
   */
  public function getAll()
  {
    // Get all transports
    $transports = $this->transportRepository->findAll();
    
    // Return transports
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Transports fetched successfully",
      'transports' => $transports,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}
