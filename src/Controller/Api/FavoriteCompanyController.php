<?php

namespace App\Controller\Api;

use App\Entity\FavoriteCompany;
use App\Repository\CompanyRepository;
use App\Repository\FavoriteCompanyRepository;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FavoriteCompanyController extends AbstractController
{


  private $companyRepository;
  private $userRepository;
  private $favoriteCompanyRepository;

  public function __construct(
    CompanyRepository $companyRepository,
    UserRepository $userRepository,
    FavoriteCompanyRepository $favoriteCompanyRepository) {
    $this->companyRepository = $companyRepository;
    $this->userRepository = $userRepository;
    $this->favoriteCompanyRepository = $favoriteCompanyRepository;
  }

  /**
   * @Route("/api/users/{userId}/favoriteCompanies", methods={"GET"})
   */
  public function getUserFavoriteCompanies($userId)
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

    // Get user favorite companies
    $favoriteCompanies = $this->favoriteCompanyRepository->findUserFavorites($userId);
    
    // Return preferences
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Favorite companies fetched successfully",
      'favoriteCompanies' => $favoriteCompanies,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/users/{userId}/favoriteCompanies", methods={"POST"})
   */
  public function addFavoriteCompany($userId, Request $request)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user
    $user = $this->userRepository->findOneById($userId);

    // Get company
    $company = $this->companyRepository->findOneBy(['id' => $parameters['company']]);

    // Return error if user or company not found
    if (!$user || !$company) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User or company not found',
      ));
    }

    // Create new favorite company
    $favoriteCompany = new FavoriteCompany();
    $favoriteCompany->setUser($user);
    $favoriteCompany->setCompany($company);

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($favoriteCompany);
    $em->flush();
    
    // Return preference
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "User favorite company added successfully",
      'favoriteCompany' => $favoriteCompany,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/favoriteCompanies/{favoriteId}", methods={"DELETE"})
   */
  public function deleteFavoriteCompany($favoriteId)
  {
    // Get favorite company
    $favoriteCompany = $this->favoriteCompanyRepository->findOneBy(['id' => $favoriteId]);

    // Return error if favorite company not found
    if (!$favoriteCompany) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Favorite company not found',
      ));
    }

    // Remove from DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($favoriteCompany);
    $em->flush();
    
    // Return delete message
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Favorite company removed successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}
