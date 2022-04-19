<?php

namespace App\Controller;

use App\Entity\Depense;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Troopers\AlertifyBundle\Helper\AlertifyHelper;


class DepenseController extends AbstractController
{
    public function index()
    {
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository(Depense::class)
            ->createQueryBuilder('q')
            ->where('q.createur = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

        $rdvs = [];

        foreach($events as $event){
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getCreatedAt()->format('Y-m-d H:i:s'),
                'end' => $event->getCreatedAt()->format('Y-m-d H:i:s'),
                'title' => $event->getReason(),

            ];
        }

        $data = json_encode($rdvs);

       return $data;
    }
    public function GetActivitiesByUser()
    {
        $data = $this->index();
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $activities = $em->getRepository(Depense::class)
            ->createQueryBuilder('q')
            ->where('q.createur = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        return $this->render('co2/activities.html.twig'
            ,array(
                "activities"=>$activities,
                "data"=>$data
            ));
    }



    public function statistiques()
    {
        $n=0;
        $em = $this->getDoctrine()->getManager();
      $userId= $this->getUser()->getId();


        $activities = $em->getRepository(Depense::class)->findBy(['createur' => $userId ]);


        $ActivityDate=[];
        $activitiesnmb=[];

        foreach ($activities as $activity){


            $datex=$activity->getCreatedAt()->format('Y-m-d');
            setlocale(LC_TIME, "fr_FR");
            $ActivityDate[]=strftime("%A %d %B ", strtotime($datex));
            $activitiesnmb[]=$activity->getCo2();
            $n=array_sum(($activitiesnmb));
        }
        return $this->render('co2/statistics.html.twig', [
            'activities'=>$activities,
            'ActivityDate'=> json_encode($ActivityDate),
            'activitiesnmb' => json_encode($activitiesnmb),
            'n' => json_encode($n)


        ]);
    }

    public function statistiquesByWeek()
    {
        $n=0;
        $em = $this->getDoctrine()->getManager();
        $userId= $this->getUser()->getId();
        $date = date('Y-m-d h:i:s', strtotime("-7 days"));
        $activities=$this->getDoctrine()
            ->getRepository(Depense::class)
            ->createQueryBuilder('e')
            ->select('e')
            ->where('e.createdAt BETWEEN :n7days AND :today')
            ->andWhere('e.createur = :id')
            ->setParameter('today', date('Y-m-d h:i:s'))
            ->setParameter('n7days', $date)
            ->setParameter('id', $userId)
            ->getQuery()
            ->getResult();




        $ActivityDate=[];
        $activitiesnmb=[];

        foreach ($activities as $activity){


            $datex=$activity->getCreatedAt()->format('Y-m-d');
            setlocale(LC_TIME, "fr_FR");
            $ActivityDate[]=strftime("%A %d %B ", strtotime($datex));
            $activitiesnmb[]=$activity->getCo2();
            $n=array_sum(($activitiesnmb));
        }
        return $this->render('co2/statistics.html.twig', [
            'activities'=>$activities,
            'ActivityDate'=> json_encode($ActivityDate),
            'activitiesnmb' => json_encode($activitiesnmb),
            'n' => json_encode($n)


        ]);
    }
    public function ShowdetailedactivityAction($id){
       $jsonDetails= $this-> getJsonDetails($id);
        $geo=null;
        $em = $this->getDoctrine()->getManager();
        $an = $em->getRepository(Depense::class)->find($id);

        return $this->render('co2/detailedactivity.html.twig', array(
            'co2'=>$an->getCo2(),
            'geo'=>$an->getGeo(),
            'createdAt'=>$an->getCreatedAt(),
            'transporttype'=>$an->getTransporttype(),
            'privacy'=>$an->getPrivacy(),
            'activities'=>$an,

            'actdetails'=>$jsonDetails

        ));
    }

    public function getJsonDetails(){


        // TODO secure ajax all request
        $repository = $this->getDoctrine()->getRepository(Depense::class);
        $allact = $repository->findAll();

        foreach ($allact as $user){
            $geoAct = ["geo" => $user->getGeo()];

            $geos=$geoAct;

        }
        foreach ($geos as $newgeos){


        }
        return new JsonResponse(
            $geos,
            JsonResponse::HTTP_OK
        );

    }


    public function getUserProfileStats($id)
    {
        $data = $this->index();

        $em = $this->getDoctrine()->getManager();
        $activities = $em->getRepository(Depense::class)
            ->createQueryBuilder('q')
            ->where('q.createur = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        return $this->render('co2/UserProfileStats.html.twig'
            ,array(
                "activities"=>$activities,
                "data"=>$data
            ));
    }

    public function UpdatePrivacy(Request $request, AlertifyHelper $alertify){
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Depense::class)
            ->find($id);
        if($event->getPrivacy()=='onlyme'){
            $event->setPrivacy('public');
        }elseif ($event->getPrivacy()=='public')
        {
            $event->setPrivacy('onlyme');
        }
        $em->persist($event);
        $em->flush();
        $alertify->congrat('Privacy Updated !');
        return $this->redirectToRoute('userActivities');
    }
}
