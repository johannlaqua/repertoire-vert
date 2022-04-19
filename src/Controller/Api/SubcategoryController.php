<?php

namespace App\Controller\Api;



use App\Entity\Category;
use App\Entity\Depense;
use App\Repository\SubcategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class SubcategoryController extends AbstractController
{


  private $subcategoryRepository;

  public function __construct(
    SubcategoryRepository $subcategoryRepository) {
    $this->subcategoryRepository = $subcategoryRepository;
  }

  /**
   * @Route("/rest/category/{id}/subcategory")
   */
  public function getAll($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    /*
      $encoders = array(new XmlEncoder(), new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());
      $serializer = new Serializer($normalizers, $encoders);
*/
    $em = $this->getDoctrine();
    $category = $em->getRepository(Category::class)->findOneBy(['id' => $id]);
    if (!$category) {
      throw $this->createNotFoundException('La categorie n\'existe pas');
    }
    //$response->setContent(var_dump($category->getsubcategories()[0]));

    $subcat = new ArrayCollection();
    foreach ($category->getsubcategories() as $subcategory) {
      $subcat->add($subcategory);
    }

    $response->setContent($this->get('serializer')->serialize($subcat, 'json'));

    return $response;
  }

  /**
   * @Route("/api/categories/{id}/subcategories/{subid}", methods={"GET"})
   */
  public function getOne($id, $subid)
  {
    // Get category
    $em = $this->getDoctrine();
    $category = $em->getRepository(Category::class)->findOneBy(['id' => $id]);
    // Get subcategory
    $subcategory = $this->subcategoryRepository->findWithProducts($subid);

    if (!$category || !$subcategory) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Category or Subcategory not found',
      ));
    }

    // Return subcategory
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Subcategory fetched successfully",
      'category' => $category->getName(),
      'subcategory' => $subcategory[0],
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}
