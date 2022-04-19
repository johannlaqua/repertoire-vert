<?php

namespace App\Controller\Api;




use App\Entity\Report;
use App\Entity\User;
use App\Repository\PostCommentRepository;
use App\Repository\PostsRepository;
use App\Repository\ReportTypeRepository;
use App\Repository\UserRepository;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ReportController extends AbstractController
{
  private $session;
  private $userRepository;
  private $postRepository;
  private $postCommentRepository;
  private $reportTypeRepository;

  public function __construct(
    UserRepository $userRepository,
    PostsRepository $postRepository,
    PostCommentRepository $postCommentRepository,
    ReportTypeRepository $reportTypeRepository
  )
  {
    $this->session = new Session();
    $this->userRepository = $userRepository;
    $this->postRepository = $postRepository;
    $this->postCommentRepository = $postCommentRepository;
    $this->reportTypeRepository = $reportTypeRepository;
  }


  /**
   * @Route("/api/reportTypes", methods={"GET"})
   */
  public function getReportTypes() {
    $reportTypes = $this->reportTypeRepository->findAll();

    // Return posts
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Posts fetched successfully",
      'content' => $reportTypes
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/reports", methods={"POST"})
   */
  public function addReport(Request $request)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user
    $user = $this->userRepository->findOneById($parameters['creator']);

    // Get report type
    $reportType = $this->reportTypeRepository->findOneBy(['id' => $parameters['reportType']]);

    // Get type of entity
    $entityType = $parameters['entity'];
    $entityId = $parameters['entityId'];
    $entity = null;

    // Get entity based on type
    switch ($entityType) {
      case 'post':
        $entity = $this->postRepository->findOneBy(['id' => $entityId]);
        break;
      case 'comment':
        $entity = $this->postCommentRepository->findOneBy(['id' => $entityId]);
        break;
    }

    if (!$user || !$entity || !$reportType) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User, ' . $entityType . ' or report type not found',
      ));
    }

    // Create report
    $report = new Report();
    $report->setCreator($user);
    $report->setMessage($parameters['message']);
    $report->setEntity($entityType);
    $report->setEntityId($entityId);
    $report->setReportType($reportType);
    $report->setStatus('open');
    $report->setCreatedAt(new \DateTime());

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($report);
    $em->flush();

    // Return created report
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "Report created successfully",
      'reportId' => $report->getId(),
      'reportDate' => $report->getCreatedAt()
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/ReportUser/{owner}",name="Report_User")
   * @Method({"POST"})
   */
  /*public function addCReportUserAction(Request $request, $owner,SerializerInterface $serializer)
    {
        //$user= $this->getUser();
        $body = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $user = $this->get("security.token_storage")->getToken()->getUser();
        $data = $serializer->deserialize($body, Report::class, 'json');
        $friend = $em->getRepository(User::class)
            ->find($owner);
        $report = new Report();

        // $user = $em->getRepository(User::class)->find($id);
        $report->setReason($data->getReason());
        $report->setUrgent($data->getReason());
        $report->setDecision('pending');
        $report->setStatus('pending');
        $report->setReasondetails($data->getReasondetails());
        $report->setCreator($user);
        $report->setOwner($friend);


        $em->persist($report);

        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'Report created!',
            'errors' => null,
            'result' => $data

        );
        return new JsonResponse($response, 200);

    }*/


  /**
   * @Route("/api/getReportsByUser/{id}",name="get_reports_by_user")
   * @Method({"GET"})
   */
  /*public function GetNotifyUser($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $notifications = $this->getDoctrine()
            ->getRepository(Report::class)
            ->createQueryBuilder('p')
            ->select("p, c, u")
            ->leftJoin('p.owner', 'c')
            ->leftJoin('p.creator', 'u')
            ->where('p.creator = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($notifications));
        return $response;
    }*/


  /**
   * @Route("/api/getReportedByUser/{id}",name="get_reported_by_user")
   * @Method({"GET"})
   */
  /*public function getReportedbyUser($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $notifications = $this->getDoctrine()
            ->getRepository(Report::class)
            ->createQueryBuilder('p')
            ->select("p, c, u")
            ->leftJoin('p.owner', 'c')
            ->leftJoin('p.creator', 'u')
            ->where('p.owner = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($notifications));
        return $response;
    }*/
}
