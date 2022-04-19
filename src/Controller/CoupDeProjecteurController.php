<?php

namespace App\Controller;

use App\Entity\CoupDeProjecteur;
use App\Form\CoupDeProjecteurType;
use App\Repository\CoupDeProjecteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coup/de/projecteur")
 */
class CoupDeProjecteurController extends AbstractController
{
    /**
     * @Route("/", name="coup_de_projecteur_index", methods={"GET"})
     */
    public function index(CoupDeProjecteurRepository $coupDeProjecteurRepository): Response
    {
        return $this->render('coup_de_projecteur/index.html.twig', [
            'coup_de_projecteurs' => $coupDeProjecteurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="coup_de_projecteur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $coupDeProjecteur = new CoupDeProjecteur();
        $form = $this->createForm(CoupDeProjecteurType::class, $coupDeProjecteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $coupDeProjecteur->setDate(new \DateTime());
            $file = $coupDeProjecteur->getPhoto();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('coupproject_directory'), $filename);
            $coupDeProjecteur->setPhoto($filename);
            $entityManager->persist($coupDeProjecteur);
            $entityManager->flush();

            return $this->redirectToRoute('coup_de_projecteur_index');
        }

        return $this->render('coup_de_projecteur/new.html.twig', [
            'coup_de_projecteur' => $coupDeProjecteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coup_de_projecteur_show", methods={"GET"})
     */
    public function show(CoupDeProjecteur $coupDeProjecteur): Response
    {

        return $this->render('coup_de_projecteur/show.html.twig', [
            'coup_de_projecteur' => $coupDeProjecteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="coup_de_projecteur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CoupDeProjecteur $coupDeProjecteur): Response
    {
        $form = $this->createForm(CoupDeProjecteurType::class, $coupDeProjecteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coup_de_projecteur_index');
        }

        return $this->render('coup_de_projecteur/edit.html.twig', [
            'coup_de_projecteur' => $coupDeProjecteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coup_de_projecteur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CoupDeProjecteur $coupDeProjecteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coupDeProjecteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coupDeProjecteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('coup_de_projecteur_index');
    }
}
