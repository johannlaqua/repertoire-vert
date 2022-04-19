<?php

namespace App\Controller;

use App\Entity\Invention;
use App\Form\InventionType;
use App\Repository\InventionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/invention")
 */
class InventionController extends AbstractController
{
    /**
     * @Route("/", name="invention_index", methods={"GET"})
     */
    public function index(InventionRepository $inventionRepository): Response
    {
        return $this->render('invention/index.html.twig', [
            'inventions' => $inventionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="invention_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $invention = new Invention();
        $form = $this->createForm(InventionType::class, $invention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $invention->setDate(new \DateTime());
            $file = $invention->getPhoto();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('coupproject_directory'), $filename);
            $invention->setPhoto($filename);
            $entityManager->persist($invention);
            $entityManager->flush();

            return $this->redirectToRoute('invention_index');
        }

        return $this->render('invention/new.html.twig', [
            'invention' => $invention,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="invention_show", methods={"GET"})
     */
    public function show(Invention $invention): Response
    {
        return $this->render('invention/show.html.twig', [
            'invention' => $invention,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="invention_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Invention $invention): Response
    {
        $form = $this->createForm(InventionType::class, $invention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invention_index');
        }

        return $this->render('invention/edit.html.twig', [
            'invention' => $invention,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="invention_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Invention $invention): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invention->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($invention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('invention_index');
    }
}
