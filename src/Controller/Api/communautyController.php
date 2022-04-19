<?php

namespace App\Controller\Api;

use App\Entity\Communauty;
use App\Repository\CommunautyRepository;
use App\Repository\UserRepository;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


class communautyController extends AbstractController
{
  private $session;
  private $userRepository;
  private $covoiturageRepository;

  public function __construct(
    UserRepository $userRepository,
    CommunautyRepository $covoiturageRepository
  ) {
    $this->session = new Session();
    $this->userRepository = $userRepository;
    $this->covoiturageRepository = $covoiturageRepository;
  }


  /**
   * @Route("/api/covoiturages", methods={"GET"})
   */
  public function getMatchingCovoiturages(Request $request)
  {
    // Get parameters
    $date = $request->query->get('departuredate');

    // Find covoiturages matching the user's criteria
    $covoiturages = $this->covoiturageRepository->findMatching($date);

    // Return covoiturages
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "covoiturages fetched successfully",
      'content' => $covoiturages
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  public function getCovoiturages()
  {
    $covoiturages = $this->covoiturageRepository->findAllWithCreator();

    // Return posts
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Posts fetched successfully",
      'content' => $covoiturages
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/covoiturages/{id}", methods={"GET"})
   */
  public function getCovoiturage($id)
  {
    $covoiturage = $this->covoiturageRepository
      ->findWithRelationships($id);
    //$covoiturage = $this->covoiturageRepository->findOneById($id);

    // Return error, if none found
    if (!$covoiturage) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Covoiturage not found',
      ));
    }

    // Return covoiturages
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Covoiturage fetched successfully",
      'content' => $covoiturage
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/covoiturages", methods={"POST"})
   */
  public function addCovoiturage(Request $request)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user
    $user = $this->userRepository->findOneById($parameters['createur']);

    if (!$user) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User not found',
      ));
    }

    $covoiturage = new Communauty();
    $covoiturage->setCreateur($user);
    $covoiturage->setDeparture($parameters['departure']);
    $covoiturage->setDestination($parameters['destination']);
    $covoiturage->setGroupmaxsize($parameters['groupmaxsize']);
    $covoiturage->setDeparturedate(new \DateTime($parameters['departuredate']));
    $covoiturage->setArrivalDate(new \DateTime($parameters['arrivalDate']));
    $covoiturage->setDepartureLatitude($parameters['departureLatitude']);
    $covoiturage->setDepartureLongitude($parameters['departureLongitude']);
    $covoiturage->setDestinationLatitude($parameters['destinationLatitude']);
    $covoiturage->setDestinationLongitude($parameters['destinationLongitude']);
    $covoiturage->setRoundTrip($parameters['roundTrip']);
    $covoiturage->setReturnDate(new \DateTime($parameters['returnDate']));
    $covoiturage->setTrunk($parameters['trunk']);
    $covoiturage->setRoof($parameters['roof']);
    $covoiturage->setTrailer($parameters['trailer']);
    $covoiturage->setCreatedAt(new \DateTime());

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($covoiturage);
    $em->flush();

    // Return created covoiturage
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "Covoiturage added successfully",
      'covoiturageId' => $covoiturage->getId(),
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/covoiturages/{id}", methods={"DELETE"})
   */
  public function deleteCovoiturage($id)
  {
    // Find covoiturage to delete
    $covoiturage = $this->covoiturageRepository->findOneById($id);

    // Return error, if none found
    if (!$covoiturage) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Covoiturage not found',
      ));
    }

    // Delete covoiturage from DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($covoiturage);
    $em->flush();

    // Return covoiturages
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Covoiturage deleted successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/rest/getcovByUser/{id}",name="getallcovbyUser")
   * @Method({"GET"})
   */
  public function GetCovByUser($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $cov = $this->getDoctrine()
      ->getRepository(Communauty::class)
      ->createQueryBuilder('p')
      ->select("p")
      ->where('p.createur = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($cov));

    return $response;
  }


  /**
   * @param Request $request
   * @param $id
   * @Route("/rest/updatecovoiturage/{id}",name="updatecov")
   * @Method({"PUT"})
   * @return JsonResponse
   */
  public function updateAction($id, Request $request, SerializerInterface $serializer)
  {
    $communauty = $this->getDoctrine()->getRepository(Communauty::class)->find($id);


    $body = $request->getContent();
    $data = $serializer->deserialize($body, Communauty::class, 'json');

    $communauty->setDeparture($data->getDeparture());
    $communauty->setDestination($data->getDestination());
    $communauty->setGroupmaxsize($data->getGroupMaxsize());
    $em = $this->getDoctrine()->getManager();
    $em->persist($communauty);
    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'User updated!',
      'errors' => null,
      'result' => null

    );
    return new JsonResponse($response, 200);
  }


  /**
   * @param Request $request
   * @param $id
   * @Route("/api/updateGroupSize/{id}",name="update_group_size")
   * @Method({"PUT"})
   * @return JsonResponse
   */
  public function updateNbPlaceAction($id, Request $request, SerializerInterface $serializer)
  {
    $communauty = $this->getDoctrine()->getRepository(Communauty::class)->find($id);


    $body = $request->getContent();
    $data = $serializer->deserialize($body, Communauty::class, 'json');



    $communauty->setGroupmaxsize($communauty->getGroupMaxsize() - 1);
    $em = $this->getDoctrine()->getManager();
    $em->persist($communauty);
    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'Nombre de palace updated!',
      'errors' => null,
      'result' => null

    );
    return new JsonResponse($response, 200);
  }
}
