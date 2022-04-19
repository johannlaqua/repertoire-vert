<?php

namespace App\Controller\Api;




use App\Entity\Company;
use App\Entity\Product;
use App\Repository\CompanyRepository;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CompanyController extends AbstractController
{

  private $logger;
  private $companyRepository;
  private $reviewRepository;
  private $productRepository;

  public function __construct(
    LoggerInterface $logger,
    CompanyRepository $companyRepository,
    ReviewRepository $reviewRepository,
    ProductRepository $productRepository
  ) {
    $this->logger = $logger;
    $this->companyRepository = $companyRepository;
    $this->reviewRepository = $reviewRepository;
    $this->productRepository = $productRepository;
  }

  /**
   * @Route("/rest/company", methods={"GET"})
   */
  public function getAll()
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $companies = $this->getDoctrine()
      ->getRepository("App:Company")
      ->createQueryBuilder('q')
      ->select('q,c')
      ->join('q.categories', 'c')
      ->where('q.activated = 1')
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($companies));

    return $response;
  }


  /**
   * @Route("/rest/company/{id}", methods={"GET"})
   */
  public function getOne($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $company = $this->getDoctrine()
      ->getRepository(Company::class)
      ->createQueryBuilder('p')
      ->where('p.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($company));


    return $response;
  }


  /**
   * @Route("/rest/companies/{id}", methods={"GET"})
   */
  public function getCompanyWithAllInfo($id)
  {
    // Get company
    $company = $this->companyRepository->getCompanyWithCategoriesAndProducts($id);

    if (!$company) {
      // Return error if no company found
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Company not found',
      ));
    }

    // Get company reviews
    $reviews = $this->reviewRepository->getAverageRating($id, 'user');

    // Get company products user reviews
    $productsUserReviews = $this->productRepository
    ->getCompanyProductsAverageRatingByRole($id, 'ROLE_USER');

    // Get company products company reviews
    $productsCompanyReviews = $this->productRepository
    ->getCompanyProductsAverageRatingByRole($id, 'ROLE_COMPANY');

    $content = array(
      'company' => $company,
      'reviews' => $reviews,
      'productsUserReviews' => $productsUserReviews,
      'productsCompanyReviews' => $productsCompanyReviews
    );

    // Return company details
    $response = new Response();
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Content-Type', 'application/json');
    $response->setStatusCode(200);
    //$response->setContent(json_encode($company[0]));
    $response->setContent(json_encode($content));
    return $response;
  }


  /**
   * @Route("/api/companies/{id}", methods={"PUT"})
   */
  public function updateCompany(Request $request, $id)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get company
    $company = $this->companyRepository->findOneBy(['id' => $id]);

    if (!$company) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Company not found',
      ));
    } else {
      $this->logger->info($company->getName());
    }

    // Update company fields
    if (array_key_exists('username', $parameters)) {
      $company->setUsername($parameters['username']);
    }

    if (array_key_exists('name', $parameters)) {
      $company->setName($parameters['name']);
    }

    if (array_key_exists('description', $parameters)) {
      $company->setDescription($parameters['description']);
    }

    if (array_key_exists('vision', $parameters)) {
      $company->setVision($parameters['vision']);
    }

    if (array_key_exists('influencezone', $parameters)) {
      $company->setInfluencezone($parameters['influencezone']);
    }

    if (array_key_exists('phone', $parameters)) {
      $company->setPhone($parameters['phone']);
    }

    if (array_key_exists('urlwebsite', $parameters)) {
      $company->setUrlwebsite($parameters['urlwebsite']);
    }

    if (array_key_exists('urlfacebook', $parameters)) {
      $company->setUrlfacebook($parameters['urlfacebook']);
    }

    if (array_key_exists('urltwitter', $parameters)) {
      $company->setUrltwitter($parameters['urltwitter']);
    }

    if (array_key_exists('urllinkedin', $parameters)) {
      $company->setUrllinkedin($parameters['urllinkedin']);
    }

    // Update company in DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($company);
    $em->flush();

    return new JsonResponse(array(
      'code' => 204,
      'message' => 'Company updated successfully',
    ));

    /*$response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->setContent(json_encode($request));*/

    //return $response;

    // Get users
    /*$user = $this->userRepository->findOneById($parameters['user']);

    $company = $this->getDoctrine()
      ->getRepository(Company::class)
      ->createQueryBuilder('p')
      ->where('p.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($company));*/
  }

  /**
   * @Route("/rest/company/search/name/{name}")
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

    $company = $this->getDoctrine()
      ->getRepository(Company::class)
      ->createQueryBuilder('p')
      ->where('p.name LIKE :name')
      ->setParameter('name', $result)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($company));


    return $response;
  }

  /**
   * @Route("/rest/company/search/address/{address}")
   */
  public function getByAddress($address)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $result = "%";
    $arr = explode(' ', $address);

    foreach ($arr as $el) {
      $result .= $el . '%';
    }

    $company = $this->getDoctrine()
      ->getRepository(Company::class)
      ->createQueryBuilder('p')
      ->where('CONCAT(p.streetnumber, p.street, p.city, p.postcode,  p.country) LIKE :address')
      ->setParameter('address', $result)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($company));


    return $response;
  }

  /**
   * @Route("/rest/company/search/{name}/{address}")
   */
  public function getByNameAndAddressSearch($name, $address)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $resultName = "%";
    $arr = explode(' ', $name);

    foreach ($arr as $el) {
      $resultName .= $el . '%';
    }

    $resultAddress = "%";
    $arr = explode(' ', $address);

    foreach ($arr as $el) {
      $resultAddress .= $el . '%';
    }

    $company = $this->getDoctrine()
      ->getRepository('AppBundle:Company')
      ->createQueryBuilder('p')
      ->where("CONCAT(p.streetnumber, p.street, p.city, p.postcode, p.country) LIKE :address")
      ->andWhere('p.name LIKE :name')
      ->setParameter('address', $resultAddress)
      ->setParameter('name', $resultName)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($company));


    return $response;
  }

  /**
   * @Route("/rest/company/search/subcategory/name/{name}")
   */
  public function getCompaniesBySubcategoryName($name)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $companies = $this->getDoctrine()
      ->getRepository("App:Company")
      ->createQueryBuilder('c')
      ->join('c.category', 'cc')
      ->join('cc.subcategories', 's')
      ->where('cc.name = :name')
      ->setParameter('name', $name)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($companies));


    return $response;
  }

  /**
   * @Route("/rest/company/search/subcategory/id/{id}")
   */
  public function getCompaniesBySubcategoryId($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $companies = $this->getDoctrine()
      ->getRepository("App:Company")
      ->createQueryBuilder('c')
      ->join('c.category', 'cc')
      ->join('cc.subcategories', 's')
      ->where('s.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($companies));


    return $response;
  }
  /**
   * @param Request $request
   * @Route("/calculate/distance", name="calculate_distance")
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   * @throws \Exception
   */
  public function distanceBetween2Points(Request $request)
  {
    $content = $request->getContent();
    $data = json_decode($content);
    if ($data == null)
      throw new \Exception("distanceBetween2Points: data is null or malformed ");

    if (!isset($data->points))
      throw new \Exception("distanceBetween2Points: data is null or malformed : Array Points is invalid or null ");

    if (!is_array($data->points))
      throw new \Exception("distanceBetween2Points: data is null or malformed : Array Points is invalid or null ");

    if (count($data->points) < 2 or count($data->points) > 2)
      throw new \Exception("distanceBetween2Points: required exactly two points");

    $distance = Calculator::calculeDistanceByGeoPoints(
      new Company($data->points[0]->lat, $data->points[0]->lng),
      new Company($data->points[1]->lat, $data->points[1]->lng)
    );
    return $this->json(array("distance" => $distance));
  }

  /**
   * @Route("/rest/Companyproducts")
   */
  public function getProductsByCompany()
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $services = $this->getDoctrine()
      ->getRepository(Product::class)
      ->createQueryBuilder('p')
      ->select("p, c,u")
      ->leftJoin('p.category', 'c')
      ->leftJoin('p.company', 'u')
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($services));

    return $response;
  }

  /**
   * @Route("/rest/category/{catId}/subcategory/{subcatId}/companies")
   */
  public function getCompaniesByProductSubcat($catId, $subcatId)
  {

      $companiesQuery = $this->getDoctrine()->getRepository(Company::class)->getCompaniesByCatAndSubcat($catId, $subcatId);
      $companies = $companiesQuery->getArrayResult();

    /*$subcat = $this->getDoctrine()->getRepository('App:Subcategory')->find($subcatId);
    $products = $subcat->getProducts();

    $data = array();
    $companies = new ArrayCollection();
    foreach ($products as $product) {

        if($product->getCompany()->getActivated() && !$companies->contains($product->getCompany())){

            $companies[] = $product->getCompany();
            $data[] = array(
                'name' => $product->getCompany()->getName(),
                'city' => $product->getCompany()->getCity(),
                'address' => $product->getCompany()->getStreet(),
                'phone' => $product->getCompany()->getPhone(),
                'website' => $product->getCompany()->getUrlwebsite(),
                'latitude' => $product->getCompany()->getLatitude(),
                'longitude' => $product->getCompany()->getLongtitude(),
            );
        }


    }*/

    return new JsonResponse($companies, Response::HTTP_OK, [], false);
  }
}
