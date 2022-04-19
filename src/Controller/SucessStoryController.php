<?php

namespace App\Controller;

use App\Entity\SucessStory;
use App\Form\SucessStoryType;
use App\Repository\SucessStoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sucess/story")
 */
class SucessStoryController extends AbstractController
{
    /**
     * @Route("/", name="sucess_story_index", methods={"GET"})
     */
    public function index(SucessStoryRepository $sucessStoryRepository): Response
    {
        return $this->render('sucess_story/index.html.twig', [
            'sucess_stories' => $sucessStoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sucess_story_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sucessStory = new SucessStory();
        $form = $this->createForm(SucessStoryType::class, $sucessStory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $sucessStory->setDate(new \DateTime());
            $file = $sucessStory->getPhoto();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('successstory_directory'), $filename);
            $sucessStory->setPhoto($filename);
            $entityManager->persist($sucessStory);
            $entityManager->flush();

            return $this->redirectToRoute('sucess_story_index');
        }

        return $this->render('sucess_story/new.html.twig', [
            'sucess_story' => $sucessStory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sucess_story_show", methods={"GET"})
     */
    public function show(SucessStory $sucessStory): Response
    {
        return $this->render('sucess_story/show.html.twig', [
            'sucess_story' => $sucessStory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sucess_story_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SucessStory $sucessStory): Response
    {
        $form = $this->createForm(SucessStoryType::class, $sucessStory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sucess_story_index');
        }

        return $this->render('sucess_story/edit.html.twig', [
            'sucess_story' => $sucessStory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sucess_story_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SucessStory $sucessStory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sucessStory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sucessStory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sucess_story_index');
    }
}
