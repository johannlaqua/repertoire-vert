<?php

namespace App\Controller;


use App\Entity\Event;
use App\Form\SearchCompanyType;
use App\Form\SearchEventType;
use App\Form\SearchProductType;
use App\Repository\CompanyRepository;
use App\Repository\CoupDeProjecteurRepository;
use App\Repository\EventRepository;
use App\Repository\NewsRepository;
use App\Repository\ProductRepository;
use App\Repository\SucessStoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
    
    /**
     * @Route("/rechercheProduit", name="rechercheProduit")
     */
    public function searchProduit(Request $request, ProductRepository $ProductRepository )
    {
        $products=[];
        $x=2;

        $products = $ProductRepository->searchProductAdvanced();

        return $this->render('search/produit.html.twig', array(
                'products'=>$products,
                'x'=>$x)
        );
    }

    /**
     * @Route("/rechercheEntreprise", name="rechercheEntreprise")
     */
    public function searchcompany(Request $request, CompanyRepository $CompanyRepositiry )
    {
        $companies=[];
        $x=0;

        $searchCompanyForm = $this->createForm(SearchCompanyType::class);
        if($searchCompanyForm->handleRequest($request)->isSubmitted() && $searchCompanyForm->isValid()){

            $criteria= $searchCompanyForm->getData();

            $companies= $CompanyRepositiry->searchCompanyAdvanced($criteria);
            $x=1;
        }
        return $this->render('search/company.html.twig', array(
                'companySearchForm' => $searchCompanyForm->createView(),
                'companies'=>$companies,
                'x'=>$x)
        );
    }

    /**
     * @Route("/rechercherEvenement", name="rechercherEvenement")
     */
    public function searchevent(Request $request, EventRepository $eventRepository,NewsRepository $NewsRepository, SucessStoryRepository $sucessStoryRepository, CoupDeProjecteurRepository $coupDeProjecteurRepository, CompanyRepository $companyRepository )
    {
        $News = $NewsRepository->findAll();
        $sucessStory = $sucessStoryRepository->findAll();
        $coupDeProjecteur = $coupDeProjecteurRepository->findAll();
        $companies = $companyRepository->findAll();

        $events = [];
        $em = $this->getDoctrine()->getManager();
        $date=(new \DateTime());

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
                'x'=>$x,
                'companies' => $companies)
        );
    }
}
