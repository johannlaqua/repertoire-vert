<?php

namespace App\Controller\Api;

use App\Entity\FavoriteCategory;
use App\Repository\CategoryRepository;
use App\Repository\FavoriteCategoryRepository;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FavoriteCategoryController extends AbstractController
{


  private $categoryRepository;
  private $userRepository;
  private $favoriteCategoryRepository;

  public function __construct(
    CategoryRepository $categoryRepository,
    UserRepository $userRepository,
    FavoriteCategoryRepository $favoriteCategoryRepository) {
    $this->categoryRepository = $categoryRepository;
    $this->userRepository = $userRepository;
    $this->favoriteCategoryRepository = $favoriteCategoryRepository;
  }

  /**
   * @Route("/api/users/{userId}/favoriteCategories", methods={"GET"})
   */
  public function getUserFavoriteCategories($userId)
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

    // Get user favorite categories
    $favoriteCategories = $this->favoriteCategoryRepository->findUserFavorites($userId);
    
    // Return preferences
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Favorite categories fetched successfully",
      'favoriteCategories' => $favoriteCategories,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/users/{userId}/favoriteCategories", methods={"POST"})
   */
  public function addFavoriteCategory($userId, Request $request)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user
    $user = $this->userRepository->findOneById($userId);

    // Get category
    $category = $this->categoryRepository->findOneBy(['id' => $parameters['category']]);

    // Return error if user or category not found
    if (!$user || !$category) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User or category not found',
      ));
    }

    // Create new favorite category
    $favoriteCategory = new FavoriteCategory();
    $favoriteCategory->setUser($user);
    $favoriteCategory->setCategory($category);

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($favoriteCategory);
    $em->flush();
    
    // Return preference
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "User favorite category added successfully",
      'favoriteCategory' => $favoriteCategory,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/favoriteCategories/{favoriteId}", methods={"DELETE"})
   */
  public function deleteFavoriteCategory($favoriteId)
  {
    // Get favorite category
    $favoriteCategory = $this->favoriteCategoryRepository->findOneBy(['id' => $favoriteId]);

    // Return error if favorite category not found
    if (!$favoriteCategory) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Favorite category not found',
      ));
    }

    // Remove from DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($favoriteCategory);
    $em->flush();
    
    // Return delete message
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Favorite category removed successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}
