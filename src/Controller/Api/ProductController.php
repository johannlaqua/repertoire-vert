<?php

namespace App\Controller\Api;

use App\Entity\Marchandise;
use App\Entity\Product;
use App\Entity\Service;
use App\Repository\CompanyRepository;
use App\Repository\MarchandiseRepository;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use App\Repository\ServiceRepository;
use App\Repository\SubcategoryRepository;
use App\Repository\UserRepository;
use Cocur\Slugify\Slugify;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ProductController  extends AbstractController
{

  private $productRepository;
  private $marchandiseRepository;
  private $reviewRepository;
  private $companyRepository;
  private $subcategoryRepository;
  private $serviceRepository;
  private $logger;

  public function __construct(
    UserRepository $userRepository,
    ReviewRepository $reviewRepository,
    ProductRepository $productRepository,
    MarchandiseRepository $marchandiseRepository,
    ServiceRepository $serviceRepository,
    CompanyRepository $companyRepository,
    SubcategoryRepository $subcategoryRepository,
    LoggerInterface $logger
  ) {
    $this->userRepository = $userRepository;
    $this->productRepository = $productRepository;
    $this->marchandiseRepository = $marchandiseRepository;
    $this->serviceRepository = $serviceRepository;
    $this->reviewRepository = $reviewRepository;
    $this->companyRepository = $companyRepository;
    $this->subcategoryRepository = $subcategoryRepository;
    $this->logger = $logger;
  }


  /**
   * @Route("/rest/product")
   */
  public function getAll()
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $products = $this->getDoctrine()
      ->getRepository(Product::class)
      ->createQueryBuilder('q')
      ->select("q, c")
      ->leftJoin('q.company', 'c')
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($products));
    //dd($products);
    return $response;
  }

  /**
   * @Route("/api/products/{id}", methods={"GET"})
   */
  public function getOne($id)
  {
    // Get product
    $product = $this->productRepository->findOneByid($id);

    // If product not found, return 404 error
    if (!$product) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Product not found',
      ));
    }

    // Get user reviews average
    $userReviews = $this->reviewRepository->getAverageRatingByRole($id, 'product', 'ROLE_USER');

    // Get company reviews average
    $companyReviews = $this->reviewRepository->getAverageRatingByRole($id, 'product', 'ROLE_COMPANY');

    // Return reviews
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Product fetched successfully",
      'product' => $product[0],
      'userReviews' => $userReviews,
      'companyReviews' => $companyReviews
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/products", methods={"POST"})
   */
  public function addProduct(Request $request)
  {

    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get users
    $company = $this->companyRepository->findOneBy(['id' => $parameters['company']]);

    // Return 404, if company not found
    if (!$company) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Company not found',
      ));
    }

    // Create new merchandise
    $merchandise = new Marchandise();
    $merchandise->setType($parameters['discr']);
    $merchandise->setName($parameters['name']);
    $merchandise->setDescription($parameters['description']);
    $merchandise->setImage($parameters['image']);
    $merchandise->setOrigin($parameters['origin']);
    $merchandise->setCertification($parameters['certification']);
    $merchandise->setPrice($parameters['price']);
    $merchandise->setCurrency($parameters['currency']);
    $merchandise->setWantevaluation(true);
    $merchandise->setGaearecommanded(false);
    $merchandise->setCreationdate(new \DateTime('now'));
    $merchandise->setUpdateddate(new \DateTime('now'));
    $merchandise->setPackaging($parameters['packaging']);
    $merchandise->setSellType($parameters['sellType']);
    $merchandise->setNiveau($parameters['niveau']);
    $merchandise->setCompany($company);

    // Set slug
    $slugify = new Slugify();
    $slug = $slugify->slugify($merchandise->getName());
    $merchandise->setSlug($slug);

    // Set product weight or volume
    $sellType = $parameters['sellType'];
    if ($sellType === 'kg' && isset($parameters['weight'])) {
      $merchandise->setWeight($parameters['weight']);
    }
    if ($sellType === 'liter' && isset($parameters['volume'])) {
      $merchandise->setVolume($parameters['volume']);
    }

    // Set dimensions
    if (isset($parameters['height'])) {
      $merchandise->setHeight($parameters['height']);
    }
    if (isset($parameters['width'])) {
      $merchandise->setWidth($parameters['width']);
    }
    if (isset($parameters['depth'])) {
      $merchandise->setDepth($parameters['depth']);
    }

    foreach ($parameters['subcategories'] as $id) {
      // Get subcategory
      $subcategory = $this->subcategoryRepository->findOneBy(['id' => $id]);

      // Add subcategory to product
      $merchandise->addSubCategory($subcategory);
    }

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($merchandise);
    $em->flush();

    // Return response
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "New product added successfully",
      'merchandise' => $merchandise->getId()
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/services", methods={"POST"})
   */
  public function addService(Request $request)
  {

    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get users
    $company = $this->companyRepository->findOneBy(['id' => $parameters['company']]);

    // Return 404, if company not found
    if (!$company) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Company not found',
      ));
    }

    // Create new merchandise
    $service = new Service();
    $service->setType($parameters['discr']);
    $service->setName($parameters['name']);
    $service->setDescription($parameters['description']);
    $service->setImage($parameters['image']);
    $service->setPrice($parameters['price']);
    $service->setCurrency($parameters['currency']);
    $service->setCertification($parameters['certification']);
    $service->setWantevaluation(true);
    $service->setGaearecommanded(false);
    $service->setCreationdate(new \DateTime('now'));
    $service->setUpdateddate(new \DateTime('now'));
    $service->setNiveau($parameters['niveau']);
    $service->setCompany($company);

    // Set slug
    $slugify = new Slugify();
    $slug = $slugify->slugify($service->getName());
    $service->setSlug($slug);

    // Set service duration
    if (isset($parameters['duration'])) {
      $service->setServiceduration($parameters['duration']);
    }

    foreach ($parameters['subcategories'] as $id) {
      // Get subcategory
      $subcategory = $this->subcategoryRepository->findOneBy(['id' => $id]);

      // Add subcategory to product
      $service->addSubCategory($subcategory);
    }

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($service);
    $em->flush();

    // Return response
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "New service added successfully",
      'service' => $service->getId()
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/products/{id}", methods={"DELETE"})
   */
  public function deleteProductOrService($id)
  {
    // Get product or service
    $product = $this->productRepository->findOneBy(['id' => $id]);

    // Return 404, if product or service not found
    if (!$product) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Product or service not found',
      ));
    }

    // Delete product image
    $path = $this->getParameter('products') . '/' . $product->getImage();
    unlink($path);

    // Delete all comments of product
    $this->reviewRepository->deleteProductReviews($id);

    // Remove from DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($product);
    $em->flush();

    // Return response
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Product or service deleted successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/products/{id}", methods={"PUT"})
   */
  public function updateProduct(Request $request, $id)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Response
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    // Get product
    $product = null;

    if ($parameters['type'] === 'marchandise') {
      $product = $this->marchandiseRepository->findOneBy(['id' => $id]);

      // Return 404, if product or service not found
      if (!$product) {
        $response->setStatusCode(RESPONSE::HTTP_NOT_FOUND);
        return $response;
      }

      // Update sell type
      if (isset($parameters['sellType'])) {
        $product->setSellType($parameters['sellType']);
      }

      // Update height
      if (isset($parameters['height'])) {
        $product->setHeight($parameters['height']);
      }

      // Update width
      if (isset($parameters['width'])) {
        $product->setWidth($parameters['width']);
      }

      // Update depth
      if (isset($parameters['depth'])) {
        $product->setDepth($parameters['depth']);
      }

      // Update weight
      if (isset($parameters['weight'])) {
        $product->setHeight($parameters['weight']);
      }
    } else {
      $product = $this->serviceRepository->findOneBy(['id' => $id]);

      // Update Service duration
      if (isset($parameters['serviceduration'])) {
        $product->setServiceduration($parameters['serviceduration']);
      }
    }

    // Update name
    if (isset($parameters['name'])) {
      $product->setName($parameters['name']);
    }

    // Update description
    if (isset($parameters['description'])) {
      $product->setDescription($parameters['description']);
    }

    // Update price
    if (isset($parameters['price'])) {
      $product->setPrice($parameters['price']);
    }

    // Update currency
    if (isset($parameters['currency'])) {
      $product->setCurrency($parameters['currency']);
    }

    // Update origin
    if (isset($parameters['origin'])) {
      $product->setOrigin($parameters['origin']);
    }

    // Update certification
    if (isset($parameters['certification'])) {
      $product->setCertification($parameters['certification']);
    }

    if (isset($parameters['subcategories'])) {

      // Get subcategories and remove all
      $subcategories = $product->getSubCategories();

      $subcategoryIds = $parameters['subcategories'];

      // Add new subcategories
      foreach ($parameters['subcategories'] as $id) {

        // Get subcategory
        $subcategory = $this->subcategoryRepository->findOneBy(['id' => $id]);

        if (!$subcategories->contains($subcategory)) {
          // Add subcategory to product
          $product->addSubCategory($subcategory);
        }
      }

      // Remove deleted subcategories
      foreach ($subcategories as $subcategory) {
        if (!in_array($subcategory->getId(), $subcategoryIds)) {
          $product->removeSubCategory($subcategory);
        }
      }
    }

    // Update in DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($product);
    $em->flush();

    $response->setStatusCode(RESPONSE::HTTP_OK);
    return $response;
  }


  /**
   * @Route("/rest/product/search/name/{name}")
   */
  public function getByName($name)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $result = "%";
    $arr = explode(' ', $name);

    foreach ($arr as $el) {
      $result .= $el . '%';
    }

    $product = $this->getDoctrine()
      ->getRepository(Product::class)
      ->createQueryBuilder('p')
      ->select("p, c")
      ->leftJoin('p.company', 'c')
      ->andWhere('p.name LIKE :name')
      ->setParameter('name', $result)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($product));

    return $response;
  }


  /**
   * @Route("/rest/product/search/address/{address}")
   */
  public function getProductsByAddress($address)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $result = "%";
    $arr = explode(' ', $address);

    foreach ($arr as $el) {
      $result .= $el . '%';
    }

    $product = $this->getDoctrine()
      ->getRepository(Product::class)
      ->createQueryBuilder('p')
      ->select("p, c")
      ->leftJoin('p.company', 'c')
      ->where('CONCAT(c.streetnumber, c.street, c.city, c.postcode, c.country) LIKE :address')
      ->setParameter('address', $result)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($product));

    return $response;
  }

  /**
   * @Route("/rest/product/fromcompany/name/{name}")
   */
  public function getAllProductsFromCompanyByName($name)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $products = $this->getDoctrine()
      ->getRepository(Product::class)
      ->createQueryBuilder('p')
      ->select("p, c, s, ca")
      ->leftJoin('p.company', 'c')
      ->join('p.subcategories', 's')
      ->join('s.categories', 'ca')
      ->where('c.name LIKE :name')
      ->setParameter('name', '%' . $name . '%')
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($products));

    return $response;
  }

  /**
   * @Route("/rest/product/fromcompany/id/{id}")
   */
  public function getAllProductsFromCompanyById($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $products = $this->getDoctrine()
      ->getRepository(Product::class)
      ->createQueryBuilder('p')
      ->where('p.company = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($products));

    return $response;
  }
}
