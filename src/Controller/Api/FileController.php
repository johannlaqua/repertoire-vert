<?php

namespace App\Controller\Api;

use App\Repository\CompanyRepository;
use App\Repository\ProductRepository;
use App\Service\FileUploader;
use DateTime;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FileController extends AbstractController
{

  public function __construct(
    LoggerInterface $logger
  ) {
    $this->logger = $logger;
  }

  /**
   * @Route("/api/images/{type}", methods={"POST"})
   */
  public function uploadImage(Request $request, FileUploader $fileUploader, $type)
  {
    // Response
    $response = new Response();
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Content-Type', 'application/json');

    $file = $request->files->get('image');
    if (!is_null($file)) {
      $path = $this->getParameter($type);
      $filename = $fileUploader->upload($file, $path);

      $content = array(
        'code' => Response::HTTP_CREATED,
        'message' => 'Image uploaded successfully',
        'image' => $filename,
      );

      // Return image name
      $response->setStatusCode(Response::HTTP_CREATED);
      $response->setContent(json_encode($content));
      return $response;
    }

    // Return image not found
    $content = array(
      'code' => Response::HTTP_NO_CONTENT,
      'message' => 'Image not found',
    );
    $response->setStatusCode(Response::HTTP_NO_CONTENT);
    $response->setContent(json_encode($content));
    return $response;
  }
}
