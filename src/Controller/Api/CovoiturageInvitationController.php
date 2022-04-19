<?php

namespace App\Controller\Api;

use App\Entity\Communauty;
use App\Entity\CovInvitation;
use App\Entity\Notification;
use App\Entity\Participation;
use App\Entity\User;
use App\Repository\CommunautyRepository;
use App\Repository\CovInvitationRepository;
use App\Repository\NotificationRepository;
use App\Repository\ParticipationRepository;
use App\Repository\UserRepository;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CovoiturageInvitationController extends AbstractController
{
  private $userRepository;
  private $covoiturageRepository;
  private $participationRepository;
  private $invitationRepository;
  private $notificationRepository;

  public function __construct(
    UserRepository $userRepository,
    CommunautyRepository $covoiturageRepository,
    ParticipationRepository $participationRepository,
    CovInvitationRepository $invitationRepository,
    NotificationRepository $notificationRepository
  ) {
    $this->userRepository = $userRepository;
    $this->covoiturageRepository = $covoiturageRepository;
    $this->participationRepository = $participationRepository;
    $this->invitationRepository = $invitationRepository;
    $this->notificationRepository = $notificationRepository;
  }


  /**
   * @Route("/api/covoiturages/{id}/covInvitations", methods={"GET"})
   */
  public function getCovoiturageInvitations(Request $request, $id)
  {
    // Get parameters
    //$covoiturageId = $request->query->get('covoiturageId');

    // Get covoiturage
    $covoiturage = $this->covoiturageRepository->findOneById($id);

    if (!$covoiturage) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Covoiturage not found',
      ));
    }

    // Get covoiturage invitations
    $invitations = $this->invitationRepository->findBy(['covoiturage' => $id]);
    //$invitations = $this->invitationRepository->findByUserAndCovoiturage($id, $covoiturageId); 

    // Return invitations
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Covoiturage invitation added successfully",
      'invitations' => $invitations,
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/covoiturages/{id}/covInvitations", methods={"POST"})
   */
  public function createInvitation(Request $request, $id)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get covoiturage
    $covoiturage = $this->covoiturageRepository->findOneById($id);

    // Get user and friend
    $user = $this->userRepository->findOneById($parameters['user']);
    $friend = $this->userRepository->findOneById($parameters['friend']);

    if (!$covoiturage || !$user || !$friend) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Covoiturage or User not found',
      ));
    }

    // Create notification first
    $notification = new Notification();
    $notification->setOwner($friend);
    $notification->setSender($user);
    $notification->setSubject('covoiturage invitation');
    $notification->setEntityId($id);
    $notification->setOpened(false);
    $notification->setCreatedAt(new \DateTime());

    // Add Notification to DB, to get id
    $em = $this->getDoctrine()->getManager();
    $em->persist($notification);
    $em->flush();

    // Create new coivoiturage invitation, with notification
    $invitation = new CovInvitation();
    $invitation->setUser($user);
    $invitation->setFriend($friend);
    $invitation->setCovoiturage($covoiturage);
    $invitation->setNotification($notification);

    // Add invitation to DB
    $em->persist($invitation);
    $em->flush();

    // Return created participation
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "Covoiturage invitation added successfully",
      'invitationId' => $invitation->getId(),
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/covoiturages/{covoiturageId}/covInvitations/{invitationId}", methods={"DELETE"})
   */
  public function deleteInvitation($invitationId)
  {
    // Get invitation
    $invitation = $this->invitationRepository->findOneBy(['id' => $invitationId]);

    if (!$invitation) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Invitation or notification not found'
      ));
    }

    // Remove from DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($invitation);
    $em->flush();

    // Return delete successful
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Covoiturage invitation deleted successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }
}
