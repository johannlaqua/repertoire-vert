<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\Person1Type;
use App\Repository\PersonRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/person")
 */
class Person1Controller extends AbstractController
{
    /**
     * @Route("/", name="person1_index", methods={"GET"})
     */
    public function index(PersonRepository $personRepository): Response
    {
        return $this->render('person/index.html.twig', [
            'people' => $personRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="person1_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        $person = new Person();
        $form = $this->createForm(Person1Type::class, $person);
        $form->handleRequest($request);
        $plainpassword = substr(str_shuffle(strtolower(sha1(rand() . time() . "awpovdhiwsdovos"))),0, 10);

        $password = $encoder->encodePassword($person, $plainpassword);
        $person->setPassword($password);

        $person->setRole('ROLE_PERSON');
        $person->setActived(false);
        $person->setEmailValidated(false);
        $person->setConnected(true);
        $person->setInscriptiondate(new DateTime());
        $token = bin2hex(random_bytes(21));
        $person->setToken($token);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($person);
            $entityManager->flush();

            return $this->redirectToRoute('person1_index');
        }

        return $this->render('person/new.html.twig', [
            'person' => $person,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="person1_show", methods={"GET"})
     */
    public function show(Person $person): Response
    {
        return $this->render('person/show.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="person1_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Person $person): Response
    {
        $form = $this->createForm(Person1Type::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('person1_index');
        }

        return $this->render('person/edit.html.twig', [
            'person' => $person,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="person1_delete", methods={"POST"})
     */
    public function delete(Request $request, Person $person): Response
    {
        if ($this->isCsrfTokenValid('delete'.$person->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($person);
            $entityManager->flush();
        }

        return $this->redirectToRoute('person1_index');
    }
}
