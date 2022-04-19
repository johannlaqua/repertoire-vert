<?php

namespace App\Controller;
use App\Entity\Event;
use App\Entity\EventFav;
use App\Form\SearchEventType;
use App\Repository\CompanyRepository;
use App\Repository\EventRepository;
use App\Repository\NewsRepository;
use App\Repository\SucessStoryRepository;
use App\Repository\CoupDeProjecteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ActualiteController extends AbstractController
{
    /**
     * @Route("/actualites", name="actualite")
     */


    public function searchevent(Request $request, EventRepository $eventRepository,NewsRepository $NewsRepository, SucessStoryRepository $sucessStoryRepository, CoupDeProjecteurRepository $coupDeProjecteurRepository, CompanyRepository $companyRepository )
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $date=(new \DateTime());
        $eventsFav = $em->getRepository(EventFav::class)->findBy(['user' => $user]);
        $UpcomingeventsFav= new ArrayCollection();
        $LastEventsFav= new ArrayCollection();
        foreach($eventsFav as $ev)
        {if($ev->getEvent()->getstartingDate()>$date)
        {$UpcomingeventsFav[]=$ev->getEvent();}
        else{$LastEventsFav[]=$ev->getEvent();}
        }

        // test
        $News = $NewsRepository->findAll();
        $sucessStory = $sucessStoryRepository->findAll();
        $coupDeProjecteur = $coupDeProjecteurRepository->findAll();
        $company = $companyRepository->findAll();

        $events = [];


        $output = $em->getRepository(Event::class)->findSixComingEvents($date);
        $Sixlastevents = array_slice($output, 0, 6);
        $SixPassedEvents = $em->getRepository(Event::class)->findSixPassedEvents($date);
        $x=0;

        $searchEventForm = $this->createForm(SearchEventType::class);
        if($searchEventForm->handleRequest($request)->isSubmitted() && $searchEventForm->isValid()){

            $criteria= $searchEventForm->getData();

            $events= $eventRepository->searchEventAdvanced($criteria);
            $x=1;
        }
        return $this->render('page/actualites.html.twig', array(
                'searchEventForm' => $searchEventForm->createView(),
                'SixPassedEvents'=>$SixPassedEvents,
                'SixUpcomingevents'=>$Sixlastevents,
                'events' => $events,
                'news' => $News,
                'sucessStory' => $sucessStory,
                'coupDeProjecteur' => $coupDeProjecteur,
                'UpcomingeventsFav' => $UpcomingeventsFav,
                'LastEventsFav' => $LastEventsFav,
                'x'=>$x,
                'companies' =>$company)
        );
    }

    /**
     * @Route("/actualites(Favoris)", name="actualite(Favoris)")
     */


    public function searcheventfav(Request $request, EventRepository $eventRepository,NewsRepository $NewsRepository, SucessStoryRepository $sucessStoryRepository, CoupDeProjecteurRepository $coupDeProjecteurRepository )
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $date=(new \DateTime());
        $eventsFav = $em->getRepository(EventFav::class)->findBy(['user' => $user]);
        $AllUpcomingeventsFav= new ArrayCollection();

        $AllLastEventsFav= new ArrayCollection();
        foreach($eventsFav as $ev)
        {if($ev->getEvent()->getstartingDate()>$date)
        {$AllUpcomingeventsFav[]=$ev->getEvent();}
        else{$AllLastEventsFav[]=$ev->getEvent();}
        }
        $UpcomingeventsFav = $AllUpcomingeventsFav->slice(0, 5);
        $LastEventsFav = $AllLastEventsFav->slice(0, 5);


        $News = $NewsRepository->findAll();
        $sucessStory = $sucessStoryRepository->findAll();
        $coupDeProjecteur = $coupDeProjecteurRepository->findAll();

        $events = [];


        $output = $em->getRepository(Event::class)->findSixComingEvents($date);
        $Sixlastevents = array_slice($output, 0, 6);
        $SixPassedEvents = $em->getRepository(Event::class)->findSixPassedEvents($date);
        $x=0;

        $searchEventForm = $this->createForm(SearchEventType::class);
        if($searchEventForm->handleRequest($request)->isSubmitted() && $searchEventForm->isValid()){

            $criteria= $searchEventForm->getData();

            $events= $eventRepository->searchEventAdvanced($criteria);
            $x=1;
        }
        return $this->render('page/actualitesFav.html.twig', array(
                'searchEventForm' => $searchEventForm->createView(),
                'SixPassedEvents'=>$SixPassedEvents,
                'SixUpcomingevents'=>$Sixlastevents,
                'events' => $events,
                'news' => $News,
                'sucessStory' => $sucessStory,
                'coupDeProjecteur' => $coupDeProjecteur,
                'UpcomingeventsFav' => $UpcomingeventsFav,
                'LastEventsFav' => $LastEventsFav,
                'x'=>$x)
        );
    }

}
