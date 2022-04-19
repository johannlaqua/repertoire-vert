<?php

namespace App\Controller\Api;




use App\Entity\Company;
use App\Entity\FavoriteCompany;
use App\Entity\FavoriteProduct;
use App\Entity\Product;
use App\Entity\ProductFav;
use App\Repository\ProductFavRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;



class FavoritesController extends AbstractController
{
  private $session;
  private $userRepository;
  private $productRepository;
  private $productFavRepository;

  public function __construct(
    UserRepository $userRepository,
    ProductRepository $productRepository,
    ProductFavRepository $productFavRepository
  ) {
    $this->userRepository = $userRepository;
    $this->productRepository = $productRepository;
    $this->productFavRepository = $productFavRepository;
    $this->session = new Session();
  }

  /**
   * @Route("/api/users/{userId}/favoriteProducts", methods={"GET"})
   */
  public function getUserFavoriteProducts($userId)
  {
    $user = $this->userRepository->findOneById($userId);

    if (!$user) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User not found',
      ));
    } else {
      $favorites = $user->getProductFavUsers();

      $serializer = $this->container->get('serializer');
      $favoritesJson = $serializer->serialize($favorites, 'json');

      return new Response($favoritesJson, Response::HTTP_OK);
    }
  }

  /**
   * @Route("/api/users/{userId}/favoriteProductsInfo")
   * @Method({"GET"})
   */
  public function getUserFavoriteProductsWithInfo($userId)
  {
    $user = $this->userRepository->findOneById($userId);

    if (!$user) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User not found',
      ));
    } else {
      $favorites = $this->productFavRepository->findAllByUserId($userId);

      $serializer = $this->container->get('serializer');
      $favoritesJson = $serializer->serialize($favorites, 'json');

      return new Response($favoritesJson, Response::HTTP_OK);
    }
  }


  /**
   * @Route("/api/users/{userId}/favoriteProducts", methods={"POST"})
   */
  public function addProductToFavorites(Request $request, $userId)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get User and Product
    $user = $this->userRepository->findOneById($userId);
    $product = $this->productRepository->findProductByid($parameters['productId']);

    if (!$user || !$product) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Product or user not found',
      ));
    } else {
      // Create favorite product
      $productFavorite = new ProductFav();
      $productFavorite->setUser($user);
      $productFavorite->setProduct($product);
      $productFavorite->setDate(new \DateTime());

      // Add to DB
      $em = $this->getDoctrine()->getManager();
      $em->persist($productFavorite);
      $em->flush();

      return new JsonResponse(array(
        'code' => Response::HTTP_CREATED,
        'message' => 'Product added to favorites successfully',
        'productId' => $parameters['productId'],
        'favoriteId' => $productFavorite->getId()
      ));
    }
  }


  /**
   * @Route("/api/users/{userId}/favoriteProducts/{productId}", methods={"DELETE"})
   */
  public function RemoveProductFromUserFavorite($userId, $productId)
  {
    $productFavorite = $this->productFavRepository->findOneByUserIdAndProductId($userId, $productId);
    if (!$productFavorite) {

      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Product is not in user favorites'
      ));
    } else {

      // Remove from DB
      $em = $this->getDoctrine()->getManager();
      $em->remove($productFavorite);
      $em->flush();

      return new JsonResponse(array(
        'code' => Response::HTTP_OK,
        'message' => 'Product is removed from user favorites successfully'
      ));
    }
  }


  /**
   * @Route("/api/users/{userId}/favoriteProducts/{productId}")
   * @Method({"GET"})
   */
  public function checkProductIsUserFavorite($userId, $productId)
  {
    $productFavorite = $this->productFavRepository->findOneByUserIdAndProductId($userId, $productId);
    if (!$productFavorite) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Product is not in user favorites'
      ));
    } else {
      return new JsonResponse(array(
        'code' => Response::HTTP_OK,
        'message' => 'Product is in user favorites'
      ));
    }
  }


  /**
   * @Route("/api/addProductToFavorite/{idProduct}",name="addPro_to_fav_list")
   * @Method({"POST"})
   */
  public function addProductToFavoriteList(Request $request, TokenStorageInterface $tokenStorage, $idProduct)
  {
    //$user= $this->getUser();

    $body = $request->getContent();
    $em = $this->getDoctrine()->getManager();
    $product = $em->getRepository(Product::class)
      ->find($idProduct);
    $user = $this->get("security.token_storage")->getToken()->getUser();
    // $data = $this->get('jms_serializer')->deserialize($body, PostLike::class, 'json');
    $FavProduct = new FavoriteProduct();

    // $user = $em->getRepository(User::class)->find($id);

    $FavProduct->setIdProduct($product);
    $FavProduct->setIdUser($user);
    $FavProduct->setDate(new \DateTime('now'));

    $em->persist($FavProduct);

    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'Product Added to Favorite List!',
      'errors' => null,
      'result' => $FavProduct

    );
    return new JsonResponse($response, 200);
  }


  /**
   * @Route("/api/addCompanyToFavorite/{idCompany}",name="addComp_to_fav_list")
   * @Method({"POST"})
   */
  public function addCompanyToFavoriteList(Request $request, TokenStorageInterface $tokenStorage, $idCompany)
  {
    //$user= $this->getUser();

    $body = $request->getContent();
    $em = $this->getDoctrine()->getManager();
    $company = $em->getRepository(Company::class)
      ->find($idCompany);
    $user = $this->get("security.token_storage")->getToken()->getUser();
    // $data = $this->get('jms_serializer')->deserialize($body, PostLike::class, 'json');
    $FavCompany = new FavoriteCompany();

    // $user = $em->getRepository(User::class)->find($id);

    $FavCompany->setIdCompany($company);
    $FavCompany->setIdUser($user);
    $FavCompany->setDate(new \DateTime('now'));

    $em->persist($FavCompany);

    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'Company Added to Favorite List!',
      'errors' => null,
      'result' => $FavCompany

    );
    return new JsonResponse($response, 200);
  }

  /**
   * @Route("/api/getFavoriteProductsByUser/{id}",name="get_fav_pro_by_user")
   * @Method({"GET"})
   */
  public function getFavproByUser($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $notifications = $this->getDoctrine()
      ->getRepository(FavoriteProduct::class)
      ->createQueryBuilder('p')
      ->select("p, c, u")
      ->leftJoin('p.idProduct', 'c')
      ->leftJoin('p.idUser', 'u')
      ->where('p.idUser = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($notifications));
    return $response;
  }

  /**
   * @Route("/api/getFavoritecompaniesByUser/{id}",name="get_fav_com_by_user")
   * @Method({"GET"})
   */
  public function getFavCOmpByuser($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $notifications = $this->getDoctrine()
      ->getRepository(FavoriteCompany::class)
      ->createQueryBuilder('p')
      ->select("p, c, u")
      ->leftJoin('p.idCompany', 'c')
      ->leftJoin('p.idUser', 'u')
      ->where('p.idUser = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($notifications));
    return $response;
  }
}
