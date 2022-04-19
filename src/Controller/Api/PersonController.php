<?php

namespace App\Controller\Api;

use App\Entity\Person;
use App\Repository\PersonRepository;
use App\Repository\ReviewRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

class PersonController extends AbstractController
{
  private $personRepository;
  private $reviewRepository;

  public function __construct(
    PersonRepository $personRepository,
    ReviewRepository $reviewRepository)
  {
    $this->personRepository = $personRepository;
    $this->reviewRepository = $reviewRepository;
  }

  /**
   * @Route("api/persons", methods={"GET"})
   */
  public function getPersons()
  {
    $persons = $this->personRepository->findAllPersons();

    $serializer = $this->container->get('serializer');
    $personsJson = $serializer->serialize($persons, 'json');

    return new Response(
      $personsJson,
      Response::HTTP_OK,
    );
  }

  /**
   * @Route("api/persons/{id}", methods={"GET"})
   */
  public function getPerson($id)
  {
    $person = $this->personRepository->findWithAllInfo($id);
    if (!$person[0]) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Fetching user failed'
      ));
    }

    // Get user number of reviews and average rating
    $reviews = $this->reviewRepository->getAverageRating($id, 'user');

    // Return user with or without reviews
    $serializer = $this->container->get('serializer');

    if ($reviews) {
      
      $response = [
        'code' => Response::HTTP_OK,
        'message' => 'User fetched successfully',
        'user' => $person[0],
        'reviews' => $reviews[0]
      ];
      $responseJson = $serializer->serialize($response, 'json');
      return new Response($responseJson);
    } else {

      $response = [
        'code' => Response::HTTP_OK,
        'message' => 'User fetched successfully',
        'user' => $person[0]
      ];
      $responseJson = $serializer->serialize($response, 'json');
      return new Response($responseJson);
    } 
  }

  /**
   * @Route("/api/persons", methods={"POST"})
   */
  public function createPerson(Request $request)
  {
    // Test merge
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Create new person
    // Parent class User attributes
    $newPerson = new Person();
    $newPerson->setgaeaUserId($parameters['gaeaUserId']);
    $newPerson->setRole('ROLE_USER');
    $newPerson->setToken(bin2hex(random_bytes(21)));
    $newPerson->setEmailValidated(true);
    $newPerson->setActived(true);
    $newPerson->setInscriptiondate(new \DateTime());
    $newPerson->setDiscr('person');
    // Person attributes
    $newPerson->setUsername($parameters['username']);
    $newPerson->setEmail($parameters['email']);
    $newPerson->setFirstName($parameters['firstname']);
    $newPerson->setLastName($parameters['lastname']);
    $newPerson->setDateBirth(new \DateTime($parameters['dateBirth']));
    $newPerson->setCity($parameters['city']);
    $newPerson->setConnected(true);

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($newPerson);
    $em->flush();

    return new JsonResponse(array(
      'code' => Response::HTTP_CREATED,
      'message' => 'User created successfully',
      'token' => $newPerson->getToken(),
      'repVertId' => $newPerson->getId()
    ));
  }
}
