<?php

namespace App\Controller\Api;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends AbstractController
{

  /**
   * @Route("/api/users/{id}/token")
   * @Method({"GET"})
   */
  public function getToken($id)
  {
    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository(User::class)->findOneBy(['gaeaUserId' => $id]);
    if (!$user) {
      return new JsonResponse(array(
        'code' => 404,
        'message' => 'User not found'
      ));
    }
    return new JsonResponse(array(
      'code' => 200,
      'token' => $user->getToken()
    ));
  }


  /**
   * @Route("/api/users/{id}/token")
   * @Method({"POST"})
   */
  public function verifyToken(Request $request, $id)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);
    $token = $parameters['token'];

    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository(User::class)->findOneBy(['gaeaUserId' => $id]);
    if (!$user) {
      return new JsonResponse(array(
        'code' => 404,
        'message' => 'User not found'
      ));
    } else {
      if ($user->getToken() === $token) {
        return new JsonResponse(array(
          'code' => 200,
          'message' => 'Token verified'
        ));
      } else {
        return new JsonResponse(array(
          'code' => 401,
          'message' => 'Bad token'
        ));
      }
    }
  }
}
