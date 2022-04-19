<?php

namespace App\Controller\Api;

use App\Entity\Review;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class ReviewController extends AbstractController
{


  private $userRepository;
  private $productRepository;
  private $reviewRepository;

  public function __construct(
    UserRepository $userRepository,
    ReviewRepository $reviewRepository,
    ProductRepository $productRepository) {
    $this->userRepository = $userRepository;
    $this->productRepository = $productRepository;
    $this->reviewRepository = $reviewRepository;
  }

  /**
   * @Route("/api/users/{id}/reviews", methods={"GET"})
   */
  public function getUserReviews($id) {

    // Get user
    $user = $this->userRepository->findOneById($id);

    // Get review
    $reviews = $this->reviewRepository->findByEntityId($id, 'user');

    // Get user reviews
    $userReviews = $this->reviewRepository->findById($id, 'user', 'ROLE_USER');

    // Get company reviews
    $companyReviews = $this->reviewRepository->findById($id, 'user', 'ROLE_COMPANY');


    // If user not found, return 404 error
    if (!$user) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User not found',
      ));
    }

    // Return reviews
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Reviews fetched successfully",
      'reviews' => $reviews,
      'userReviews' => $userReviews,
      'companyReviews' => $companyReviews
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/products/{id}/reviews", methods={"GET"})
   */
  public function getProductReviews($id) {

    // Get product
    $product = $this->productRepository->findOneBy(['id' => $id]);

    // Get review
    $reviews = $this->reviewRepository->findByEntityId($id, 'product');

    // Get user reviews
    $userReviews = $this->reviewRepository->findById($id, 'product', 'ROLE_USER');

    // Get company reviews
    $companyReviews = $this->reviewRepository->findById($id, 'product', 'ROLE_COMPANY');

    // If product not found, return 404 error
    if (!$product) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Product not found',
      ));
    }

    // Return reviews
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Reviews fetched successfully",
      'reviews' => $reviews,
      'userReviews' => $userReviews,
      'companyReviews' => $companyReviews,
      'companyId' => $product->getCompany()
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/reviews", methods={"POST"})
   */
  function addReview(Request $request) {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get review owner
    $owner = $this->userRepository->findOneById($parameters['owner']);

    // Get reviewed entity
    $entityType = $parameters['entityType'];
    $user = null;
    $product = null;

    if ($entityType === 'user') {
      $user = $this->userRepository->findOneById($parameters['entityId']);

      // If user not found, return 404 error
      if (!$user) {
        return new JsonResponse(array(
          'code' => Response::HTTP_NOT_FOUND,
          'message' => 'User not found',
        ));
      }
    } else {
      $product = $this->productRepository->findOneBy(["id" => $parameters['entityId']]);
    
      // If product not found, return 404 error
      if (!$product) {
        return new JsonResponse(array(
          'code' => Response::HTTP_NOT_FOUND,
          'message' => 'Product not found',
        ));
      }
    }

    // If owner not found, return 404 error
    if (!$owner) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User or ' . $entityType . ' not found',
      ));
    }

    // New review
    $review = new Review();
    $review->setOwner($owner);
    $review->setValue($parameters['value']);
    $review->setEntityId($parameters['entityId']);
    $review->setEntityType($parameters['entityType']);
    $review->setComment($parameters['comment']);
    $review->setCreatedAt(new \DateTime());

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($review);
    $em->flush();

    // Return created review
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "Review created successfully",
      'reviewId' => $review->getId(),
      'reviewDate' => $review->getCreatedAt()
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}