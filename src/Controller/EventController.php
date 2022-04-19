<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\EventFav;
use App\Form\EventType;
use App\Repository\EventFavRepository;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/MesFavoris", name="eventsFav")
     * @return
     */
    public function eventsFav()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $eventsFav = $em->getRepository(EventFav::class)->findBy(['user' => $user]);
        $events= new ArrayCollection();
        foreach($eventsFav as $ev)
        {
            $events[]=$ev->getEvent();
        }
        return $this->render('event/eventsFav.html.twig', [
            'events' => $events,
            'eventsFav'=>$eventsFav
        ]);
    }
    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/indexAdmin.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user=$this->getUser();
            $event->setUser($user);
            $entityManager->persist($event);
            $entityManager->flush();
            if($user->getRoles()=='ROLE_ADMIN')
            {
                return $this->redirectToRoute('event_index');
            }
            else{
                return $this->redirectToRoute('CompanyEvents');
            }
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {


        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $em = $this->getDoctrine()->getManager();
            $user=$this->getUser();
            $eventFav = $em->getRepository(EventFav::class)->findOneBy( array('user' => $user,'event' => $event ) );

            if($eventFav == null)
            {
                $n=0;

            } else {
                $n=1;

            }


        } else {
            $n=3;

        }
        return $this->render('event/show.html.twig', [
            'event' => $event,
            'n'=>$n
        ]);
    }

    /**
     * @Route("/{id}", name="event_showAdmin", methods={"GET"})
     */
    public function showAdmin(Event $event): Response
    {



        return $this->render('event/showAdmin.html.twig', [

        ]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_index');
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_index');
    }


}
