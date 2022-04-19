<?php

namespace App\Controller\Api;




use App\Entity\DiscussionQuote;
use App\Entity\ServiceOfferCategories;
use App\Entity\ServiceOfferUser;
use App\Entity\Services;
use App\Entity\User;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;



class ServiceOffersController extends AbstractController
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }



    /**
     * @Route("/api/GetAllservices",name="get_al_services")
     * @Method({"GET"})
     */
    public function getAll()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $services = $this->getDoctrine()
            ->getRepository(Services::class)
            ->createQueryBuilder('q')
            ->select("q, c,u")
            ->leftJoin('q.company', 'c')
            ->leftJoin('q.category', 'u')
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($services));

        return $response;

    }
    /**
     * @Route("/api/getServicesDetails/{id}")
     */
    public function getOneOffer($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $post=$this->getDoctrine()
            ->getRepository(Services::class)
            ->createQueryBuilder('p')
            ->select("p, u")
            ->leftJoin('p.company', 'u')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($post));

        return $response;
    }


    /**
     * @Route("/api/getServiceCostDevis/{idService}/{idUser}",name="get_service_cost_devis")
     * @Method({"POST"})
     */
    public function DemanderInfoEtDevis(Request $request, TokenStorageInterface $tokenStorage,$idUser, $idService,SerializerInterface $serializer)
    {
        //$user= $this->getUser();

        $body = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository(Services::class)
            ->find($idService);
        $company = $em->getRepository(User::class)
            ->find($idUser);
        $user = $this->get("security.token_storage")->getToken()->getUser();
         $data = $serializer->deserialize($body, ServiceOfferUser::class, 'json');
        $ServiceOfferUser = new ServiceOfferUser();

        // $user = $em->getRepository(User::class)->find($id);

        $ServiceOfferUser->setService($service);
        $ServiceOfferUser->setUser($user);
        $ServiceOfferUser->setCompany($company);
        $ServiceOfferUser->setDevis($data->getDevis());
        $ServiceOfferUser->setDate(new \DateTime('now'));

        $em->persist($ServiceOfferUser);

        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'Devis cost added!',
            'errors' => null,
            'result' => $ServiceOfferUser

        );
        return new JsonResponse($response, 200);

    }

    /**
     * @Route("/rest/offerByCategory/{idCat}")
     */
    public function getOfferbyCategoryName($idCat)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $services = $this->getDoctrine()
            ->getRepository(Services::class)
            ->createQueryBuilder('p')
            ->select("p, c, u")
            ->leftJoin('p.company', 'c')
            ->leftJoin('p.category', 'u')
            ->where('p.category = :id')
            ->setParameter('id', $idCat)
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($services));

        return $response;

    }


    /**
     * @Route("/rest/getCatsServices",name="getCatsServices")
     * @Method({"GET"})
     */
    public function getAllCats()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $cats = $this->getDoctrine()
            ->getRepository(ServiceOfferCategories::class)
            ->createQueryBuilder('q')
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($cats));

        return $response;

    }
    /**
     * @Route("/api/getQuoteDetails/{id}")
     */
    public function getQuotedatails($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $post=$this->getDoctrine()
            ->getRepository(ServiceOfferUser::class)
            ->createQueryBuilder('p')
            ->select("p, u, c,y")
            ->leftJoin('p.company', 'u')
            ->leftJoin('p.service', 'c')
            ->leftJoin('p.user', 'y')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($post));

        return $response;
    }
    /**
     * @Route("/api/sendQUestion/{recipient}/{service}",name="send_question")
     * @Method({"POST"})
     */
    public function SendMessageAction(Request $request, $recipient,$service,SerializerInterface $serializer)
    {
        //$user= $this->getUser();
        $body = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $user = $this->get("security.token_storage")->getToken()->getUser();
        $data = $serializer->deserialize($body, DiscussionQuote::class, 'json');
        $friend = $em->getRepository(User::class)
            ->find($recipient);
        $service = $em->getRepository(ServiceOfferUser::class)
            ->find($service);
        $message = new DiscussionQuote();

        // $user = $em->getRepository(User::class)->find($id);
        $message->setQuestion($data->getQuestion());
        $message->setRecipient($friend);
        $message->setService($service);
        $message->setSender($user);
        $message->setDate(new \DateTime('now'));


        $em->persist($message);

        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'Message send created!',
            'errors' => null,
            'result' => $data

        );
        return new JsonResponse($response, 200);

    }


    /**
     * @Route("/api/getDiscussionQuote/{id}/{user}",name="get_discussion_Quote")
     * @Method({"GET"})
     */
    public function GetMessageyUser($id,$user)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $messages = $this->getDoctrine()
            ->getRepository(DiscussionQuote::class)
            ->createQueryBuilder('p')
            ->select("p, c, u")
            ->leftJoin('p.recipient', 'c')
            ->leftJoin('p.sender', 'u')
            ->where('p.service = :id')
            ->andWhere('p.recipient = :user')
            ->orderBy('p.date', 'ASC')
            ->setParameters(array('id'=> $id, 'user' => $user))
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($messages));
        return $response;
    }




    /**
     * @Route("/api/getDiscussionQuoteByRec/{user}/{id}",name="get_discussion_Quote_by_rec")
     * @Method({"GET"})
     */
    public function getQuotediscussionbyRecepient($id,$user)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $messages = $this->getDoctrine()
            ->getRepository(DiscussionQuote::class)
            ->createQueryBuilder('p')
            ->select("p, c, u")
            ->leftJoin('p.recipient', 'c')
            ->leftJoin('p.sender', 'u')
            ->where('p.service = :id')
            ->andWhere('p.sender = :user')
            ->orderBy('p.date', 'ASC')
            ->setParameters(array('id'=> $id, 'user' => $user))
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($messages));
        return $response;
    }



    /**
     * @Route("/api/quotedemandbyUser/{user}")
     */
    public function getDevisDemandByUser($user)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $services = $this->getDoctrine()
            ->getRepository(ServiceOfferUser::class)
            ->createQueryBuilder('p')
            ->select("p, c,u")
            ->leftJoin('p.service', 'c')
            ->leftJoin('p.company', 'u')
            ->where('p.user = :id')
            ->setParameter('id', $user)
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($services));

        return $response;

    }

    /**
     * @Route("/api/addService/{idCat}",name="addService")
     * @Method({"POST"})
     */
    public function addService(Request $request, TokenStorageInterface $tokenStorage,$idCat,SerializerInterface $serializer)
    {
        //$user= $this->getUser();

        $body = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $user = $this->get("security.token_storage")->getToken()->getUser();
        $data = $serializer->deserialize($body, Services::class, 'json');
        $service = new Services();

         $category = $em->getRepository(ServiceOfferCategories::class)->find($idCat);
        $service->setDescription($data->getDescription());
        $service->setCompany($user);
        $service->setCategory($category);
        $service->setField($data->getField());
        $service->setType($data->getType());

        $em->persist($service);

        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'Post created!',
            'errors' => null,
            'result' => $data

        );
        return new JsonResponse($response, 200);

    }


    /**
     * @Route("/rest/getOfferedServicesByCompany/{idCom}")
     */
    public function getServicesbyCompany($idCom)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $services = $this->getDoctrine()
            ->getRepository(Services::class)
            ->createQueryBuilder('p')
            ->select("p, c,u")
            ->leftJoin('p.company', 'c')
            ->leftJoin('p.category', 'u')
            ->where('p.company = :id')
            ->setParameter('id', $idCom)
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($services));

        return $response;

    }
    /**
     * @Route("/api/addCategoryForService",name="add_cat_for_serv")
     * @Method({"POST"})
     */
    public function AddServiceCategory(Request $request, TokenStorageInterface $tokenStorage,SerializerInterface $serializer)
    {
        //$user= $this->getUser();

        $body = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $company = $this->get("security.token_storage")->getToken()->getUser();
        $data = $serializer->deserialize($body, ServiceOfferCategories::class, 'json');
        $servcat = new ServiceOfferCategories();

        // $category = $em->getRepository(ServiceOfferCategories::class)->find($idCat);
        $servcat->setDescription($data->getDescription());
        $servcat->setName($data->getName());
        $servcat->setCompany($company);
        $servcat->setSlug($data->getSlug());
        $servcat->setImage($data->getImage());
        $em->persist($servcat);

        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'Category created!',
            'errors' => null,
            'result' => $data

        );
        return new JsonResponse($response, 200);

    }

    /**
     * @Route("/rest/getCategoriesByCompany/{idCom}")
     */
    public function getCategoriesByCompany($idCom)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $categories = $this->getDoctrine()
            ->getRepository(ServiceOfferCategories::class)
            ->createQueryBuilder('p')
            ->select("p")
            ->where('p.company = :id')
            ->setParameter('id', $idCom)
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($categories));

        return $response;

    }

    /**
     * @Route("/api/deleteCategoryService/{id}",name="delete_cat_service")
     * @Method({"DELETE"})
     */
    public function deleteCov($id)
    {

        $cat = $this->getDoctrine()->getRepository(ServiceOfferCategories::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($cat);
        $em->flush();

        $response = array(

            'code' => 0,
            'message' => 'Category  deleted !',
            'errors' => null,
            'result' => null

        );
        return new JsonResponse($response, 200);
    }


    /**
     * @Route("/api/deleteServiceByComp/{id}",name="delete_service_comp")
     * @Method({"DELETE"})
     */
    public function deleteServiceByComp($id)
    {

        $serv = $this->getDoctrine()->getRepository(Services::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($serv);
        $em->flush();

        $response = array(

            'code' => 0,
            'message' => 'Service  deleted !',
            'errors' => null,
            'result' => null

        );
        return new JsonResponse($response, 200);
    }

}

