<?php

namespace App\Controller\Api;

use App\Entity\Communauty;
use App\Entity\Participation;
use App\Entity\User;
use App\Repository\CommunautyRepository;
use App\Repository\ParticipationRepository;
use App\Repository\UserRepository;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class CovoiturageParticipationController extends AbstractController
{
  private $userRepository;
  private $covoiturageRepository;
  private $participationRepository;

  public function __construct(
    UserRepository $userRepository,
    CommunautyRepository $covoiturageRepository,
    ParticipationRepository $participationRepository
  ) {
    $this->userRepository = $userRepository;
    $this->covoiturageRepository = $covoiturageRepository;
    $this->participationRepository = $participationRepository;
  }


  /**
   * @Route("/api/covoiturages/{idCovoiturage}/participations", methods={"POST"})
   */
  public function createParticipation(Request $request, $idCovoiturage)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get covoiturage
    $covoiturage = $this->covoiturageRepository->findOneById($idCovoiturage);

    // Get user
    $user = $this->userRepository->findOneById($parameters['participantId']);

    if (!$covoiturage || !$user) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Covoiturage or User not found',
      ));
    }

    // Create new coivoiturage participation
    $participation = new Participation();
    $participation->setParticipant($user);
    $participation->setCovoiturage($covoiturage);
    $participation->setConfirmed(false);

    // Add participation to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($participation);
    $em->flush();

    // Return created participation
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "Covoiturage participation added successfully",
      'participationId' => $participation->getId(),
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/covoiturages/{covoiturageId}/participations/{id}", methods={"PUT"})
   */
  public function acceptParticipation($id)
  {
    // Get participation
    $participation = $this->participationRepository->findOneBy(['id' => $id]);

    // Return error if not found
    if (!$participation) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Participation not found'
      ));
    }

    // Set participation status to confirmed
    $participation->setConfirmed(true);

    // Remove from DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($participation);
    $em->flush();

    // Return created participation
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Covoiturage participation accepted successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/covoiturages/{covoiturageId}/participations/{participationId}", methods={"DELETE"})
   */
  public function deleteParticipation($participationId)
  {
    // Get participation
    $participation = $this->participationRepository->findOneBy(['id' => $participationId]);

    // Return error if not found
    if (!$participation) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Participation not found'
      ));
    }

    // Remove from DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($participation);
    $em->flush();

    // Return created participation
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Covoiturage participation deleted successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/inviteFriendCov/{idcov}/{idpar}",name="inviter_cov")
   * @Method({"POST"})
   */
  public function InviteCovAction(Request $request, TokenStorageInterface $tokenStorage, $idcov, $idpar)
  {

    //$friend = $request->get('friend');
    $em = $this->getDoctrine()->getManager();
    $cov = $em->getRepository(Communauty::class)
      ->find($idcov);
    $friend = $em->getRepository(User::class)
      ->find($idpar);

    $invit = new Participation();


    $invit->setParticipant($friend);
    $invit->setCovoiturage($cov);
    $invit->setConfirmed(false);

    $em = $this->getDoctrine()->getManager();
    $em->persist($invit);

    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'Invit Request sent!',
      'errors' => null,
      'result' => $invit

    );
    return new JsonResponse($response, 200);
  }


  /**
   * @Route("/api/getInvitCovByParticipant/{id}")
   */
  public function getInvitationcovByParticipant($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $invit = $this->getDoctrine()
      ->getRepository(Participation::class)
      ->createQueryBuilder('p')
      ->select("p, c, u")
      ->leftJoin('p.covoiturage', 'c')
      ->leftJoin('p.participant', 'u')
      ->where('u.id = :id')
      ->andWhere('p.confirmed = false')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($invit));
    return $response;
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

  /**
   * @Route("/rest/getpartByUser/{id}",name="getallpartbyUser")
   * @Method({"GET"})
   */
  public function getParticpationsByUser($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $cov = $this->getDoctrine()
      ->getRepository(Participation::class)
      ->createQueryBuilder('p')
      ->select("p,u")
      ->where('p.participant = :id')
      ->leftJoin('p.covoiturage', 'u')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($cov));

    return $response;
  }
}
