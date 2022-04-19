<?php

namespace App\Controller\Api;

use App\Repository\CompanyRepository;
use App\Repository\ProductRepository;
use DateTime;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class NewsController extends AbstractController
{

  private $companyRepository;
  private $productRepository;

  public function __construct(
    CompanyRepository $companyRepository,
    ProductRepository $productRepository,
    LoggerInterface $logger) {
    $this->companyRepository = $companyRepository;
    $this->productRepository = $productRepository;
    $this->logger = $logger;
  }

  /**
   * @Route("/api/news/{filter}", methods={"GET"})
   */
  public function getLatestCompaniesAndProducts($filter)
  {
    // Get date today
    $today = new DateTime('today midnight');

    // Date from which we want news
    $date = $today;

    // Companies and products
    $newCompanies = [];
    $newProducts = [];

    // Get date based on filter (today, week, month, ...)
    switch ($filter) {
      case 'latest':
        $date->modify("last monday midnight");
        break;
      case 'today':
        $date = $today;
        break;
      case 'week':
        $date->modify("last monday midnight");
        break;
      case 'month':
        $date->modify("first day of this month");
        break;
      case 'threeMonths':
        $date->modify("first day of -2 month");
        break;
      case 'sixMonths':
        $date->modify("first day of -5 month");
        break;
    }

    // Get 5 latest companies & products
    $newCompanies = $this->companyRepository->findLatestCompanies($date);
    $newProducts = $this->productRepository->findLatestProducts($date);

    // Create Response array
    $content = array(
      'code' => Response::HTTP_OK,
      'message' => 'Latest companies and products fetched successfully',
      'companies' => $newCompanies,
      'products' => $newProducts
    );

    // Return JSON
    $response = new Response();
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Content-Type', 'application/json');
    $response->setStatusCode(200);
    $response->setContent(json_encode($content));
    return $response;
  }
}
