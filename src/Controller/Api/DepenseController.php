<?php

namespace App\Controller\Api;



use App\Entity\Co2EmissionPerWeek;
use App\Entity\Depense;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class DepenseController extends AbstractController
{

    /**
     * @param Request $request
     * @Route("/api/depense",name="depense")
     * @Method({"POST"})
     * @return JsonResponse
     */
    public function AddDepense(Request $request,SerializerInterface $serializer)
    {


        $body = $request->getContent();
        $data = $serializer->deserialize($body, Depense::class, 'json');
        $user = $this->get("security.token_storage")->getToken()->getUser();
        $depense = new Depense();
        $depense->setSteps($data->getSteps());
        $depense->setCalories($data->getCalories());
        $depense->setCo2($data->getCo2());
        $depense->setCreateur($user);
        $depense->setPrivacy('onlyme');
        $depense->setTransporttype($data->getTransporttype());
        $depense->setReason($data->getReason());
        $depense->setGeo($data->getGeo());
        $depense->setDistance($data->getDistance());
        $depense->setCreatedAt(new \DateTime('now'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($depense);
        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'Depense created!',
            'errors' => null,
            'result' => $data

        );
        return new JsonResponse($response, 200);
    }
    /**
     * @param Request $request
     * @Route("/rest/getperyear/{year}",name="getperyear")
     * @Method({"GET"})
     * @return JsonResponse
     */
    public function findByMonthYear( $year)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $fromTime = new \DateTime($year);
        $toTime = new \DateTime($fromTime->format('Y-m-d') . ' first day of next month');
        $depenses = $this->getDoctrine()
            ->getRepository(Depense::class)
        ->createQueryBuilder('p')
            ->where('p.createdAt >= :fromTime')
            ->andWhere('p.createdAt < :toTime')
        ->setParameter('fromTime', $fromTime)
        ->setParameter('toTime', $toTime)
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($depenses));
        return $response;
    }

    /**
     * @param Request $request
     * @Route("/api/depense/getpermonth/{year}/{month}/{id}",name="getpermonth")
     * @Method({"GET"})
     * @return JsonResponse
     */
    public function findByMonth( $month,$year, $id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $fromTime = new \DateTime($year . '-' . $month . '-01');
        $toTime = new \DateTime($fromTime->format('Y-m-d') . ' first day of next month');   
         $depenses = $this->getDoctrine()
            ->getRepository(Depense::class)
            ->createQueryBuilder('p')
            ->where('p.createdAt >= :fromTime')
            ->andWhere('p.createdAt < :toTime')
             ->andWhere('p.createur = :id')
            ->setParameter('fromTime', $fromTime)
            ->setParameter('toTime', $toTime)
             ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($depenses));
        return $response;
    }

    /**
     * @param Request $request
     * @Route("/rest/getdepense",name="get_depense")
     * @Method({"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $depenses = $this->getDoctrine()
            ->getRepository(Depense::class)
            ->createQueryBuilder('q')
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($depenses));

        return $response;
    }
    /**
     * @param Request $request
     * @Route("/rest/getdepensedetails/{id}",name="get_depense_details")
     * @Method({"GET"})
     * @return JsonResponse
     */
    public function getDepenseDetails($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $depense=$this->getDoctrine()
            ->getRepository(Depense::class)
            ->createQueryBuilder('p')
            ->select("p")
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($depense));
        return $response;
    }



    /**
     * @param Request $request
     * @Route("/api/depense/getperWeek/{id}",name="getperweek")
     * @Method({"GET"})
     * @return JsonResponse
     */
    public function findByWeek($id )
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $date = date('Y-m-d h:i:s', strtotime("-7 days"));

 $depenses=$this->getDoctrine()
     ->getRepository(Depense::class)
    ->createQueryBuilder('e')
    ->select('e')
    ->where('e.createdAt BETWEEN :n7days AND :today')
     ->andWhere('e.createur = :id')
    ->setParameter('today', date('Y-m-d h:i:s'))
    ->setParameter('n7days', $date)
     ->setParameter('id', $id)
    ->getQuery()
    ->getArrayResult();
        $response->setContent(json_encode($depenses));
        return $response;
    }

    /**
     * @param Request $request
     * @Route("/rest/depense/getpertwoWeeks/{id}",name="getperTwoweek")
     * @Method({"GET"})
     * @return JsonResponse
     */
    public function findByTwoWeeks($id )
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $date = date('Y-m-d h:i:s', strtotime("-21 days"));

        $depenses=$this->getDoctrine()
            ->getRepository(Depense::class)
            ->createQueryBuilder('e')
            ->select('e')
            ->where('e.createdAt BETWEEN :n21days AND :today')
            ->andWhere('e.createur = :id')
            ->setParameter('today', date('Y-m-d h:i:s'))
            ->setParameter('n21days', $date)
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($depenses));
        return $response;
    }

    /**
     * @Route("/api/getdepbyuser/{id}",name="getdep_by_user")
     * @Method({"GET"})
     */
    public function GetDepByUser($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $depense=$this->getDoctrine()
            ->getRepository(Depense::class)
            ->createQueryBuilder('p')
            ->select("p")
            ->where('p.createur = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($depense));
        return $response;
    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/api/updatecovPrivacy/{id}",name="updatecovprivacy")
     * @Method({"PUT"})
     * @return JsonResponse
     */
    public function updatecovPrivacyAction($id,Request $request,SerializerInterface $serializer)
    {
        $depense=$this->getDoctrine()->getRepository(Depense::class)->find($id);


        $body=$request->getContent();
        $data=$serializer->deserialize($body,Depense::class,'json');

        $depense->setPrivacy($data->getPrivacy());
        $em = $this->getDoctrine()->getManager();
        $em->persist($depense);
        $em->flush();

        $response=array(
            'code'=>0,
            'message'=>'User updated!',
            'errors'=>null,
            'result'=>null

        );
        return new JsonResponse($response,200);

    }


    /**
     * @Route("/rest/calculateCo2ByUser/{id}",name="calculate_co2_by_user")
     * @Method({"GET"})
     */
    public function CalculateCo2ByUser($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $depense=$this->getDoctrine()
            ->getRepository(Depense::class)
            ->createQueryBuilder('p')
            ->select("p")
            ->where('p.createur = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        foreach($depense as $event)
        {
            print_r($event);
        }
        $response->setContent(json_encode($depense));
        return $response;
    }



    /**
     * @param Request $request
     * @Route("/api/co2emissionperweek",name="co2_emission_perweek")
     * @Method({"POST"})
     * @return JsonResponse
     */
    public function AddCo2EmissionPerWeek(Request $request,SerializerInterface $serializer)
    {


        $body = $request->getContent();
        $data = $serializer->deserialize($body, Co2EmissionPerWeek::class, 'json');
        $user = $this->get("security.token_storage")->getToken()->getUser();
        $depense = new Co2EmissionPerWeek();
       $depense->setUser($user);
        $depense->setTotalco2($data->getTotalco2());
        $depense->setCreatedAt(new \DateTime('now'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($depense);
        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'co2 emission per week  created!',
            'errors' => null,
            'result' => $data

        );
        return new JsonResponse($response, 200);
    }

    /**
     * @Route("/api/getTotalco2perweekbyUser",name="getTotal_co2_perweek_byUser")
     * @Method({"GET"})
     */
    public function getTotalco2EmissionPerweekByUser()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $id=$this->getUser()->getId();
        $depense=$this->getDoctrine()
            ->getRepository(Co2EmissionPerWeek::class)
            ->createQueryBuilder('p')
            ->select("p")
            ->where('p.user = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)

            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($depense));
        return $response;
    }

}
