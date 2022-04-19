<?php

namespace App\Controller\Api;

use App\Repository\CartRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class OrderController extends AbstractController
{

  private $cartRepository;
  private $userRepository;

  public function __construct(
    CartRepository $cartRepository,
    UserRepository $userRepository
  ) {
    $this->cartRepository = $cartRepository;
    $this->userRepository = $userRepository;
  }


  /**
   * @Route("/api/users/{id}/orders")
   * @Method({"GET"})
   */
  public function getOrders($id)
  {
    // Get user
    $user = $this->userRepository->findOneById($id);

    if (!$user) {
      // Return user not found error
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'content' => 'User not found',
      ));
    }

    // Get user orders
    $orders = $this->cartRepository->findUserOrders($id);

    // Return orders
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => 200,
      'content' => $orders
    ];
    $ordersJson = $serializer->serialize($response, 'json');

    return new Response($ordersJson, Response::HTTP_OK);
  }
  
}
