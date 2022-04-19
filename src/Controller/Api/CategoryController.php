<?php

namespace App\Controller\Api;



use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class CategoryController extends AbstractController
{

  private $categoryRepository;

  public function __construct(
    CategoryRepository $categoryRepository
  ) {
    $this->categoryRepository = $categoryRepository;
  }

  /**
   * @Route("/rest/category")
   */
  public function getAll()
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $categories = $this->getDoctrine()->getRepository(Category::class)->createQueryBuilder('q')
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($categories));

    return $response;
  }
  /**
   * @Route("/rest/category/{id}")
   */
  public function getOne($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $category = $this->getDoctrine()
      ->getRepository(Category::class)
      ->createQueryBuilder('p')
      ->select("p, c")
      ->leftJoin('p.subcategories', 'c')
      ->where('p.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($category));
    return $response;
  }


  /**
   * @Route("/api/categories", methods={"GET"})
   */
  public function getCategoriesWithSubcategories()
  {
    // Categories with subcategories
    $categories = $this->categoryRepository->findAllWithSubcategories();

    // Response
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->setStatusCode(RESPONSE::HTTP_OK);
    $response->setContent(json_encode($categories));
    return $response;
  }


  /**
   * @Route("/rest/productsByCategory/{cat}")
   */
  public function getProductsByCategory($cat)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $services = $this->getDoctrine()
      ->getRepository(Product::class)
      ->createQueryBuilder('p')
      ->select("p, c")
      ->leftJoin('p.category', 'c')

      ->where('p.category = :id')
      ->setParameter('id', $cat)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($services));

    return $response;
  }

  /**
   * @Route("/rest/category/subcategory/{id}")
   */
  public function getCategoryBySubcat($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $category = $this->getDoctrine()
      ->getRepository(Category::class)
      ->createQueryBuilder('c')
      ->select("c")
      ->leftJoin('c.subcategories', 's')
      ->where('s.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($category));
    return $response;
  }

  /**
   * @Route("/rest/categoriesByCompany/{companyId}")
   */
  public function getCategoriesByCompany($companyId)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $categories = $this->getDoctrine()
      ->getRepository(Category::class)
      ->createQueryBuilder('c')
      ->leftJoin('c.companies', 'co')
      ->where('co.id = :id')
      ->setParameter('id', $companyId)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($categories));

    return $response;
  }
}
