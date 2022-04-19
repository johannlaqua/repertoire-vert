<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\EventFav;
use App\Entity\ProductFav;
use App\Form\CompanyType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Person;
use App\Form\PersonType;
use Cocur\Slugify\Slugify;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PersonController extends AbstractController
{
    /**
     * @Route("/person", name="person")
     */
    public function index(): Response
    {
        return $this->render('person/index.html.twig', [
            'controller_name' => 'PersonController',
        ]);
    }
    /**
     * @Route("/inscription-particulier/", name="personRegister")
     */
    public function registerAction(Request $request,UserPasswordEncoderInterface $encoder,\Swift_Mailer $mailer)
    {
        // Create a new blank user and process the form
        $company = new Person();
        //$company->setDiscr('user');
        $form = $this->createForm(PersonType::class, $company);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Encode the new users password

            $password = $encoder->encodePassword($company, $company->getPlainPassword());
            $company->setPassword($password);

            // Set their role
            $company->setRole('ROLE_USER');
            $slugify = new Slugify();


            $company->setActived(true);
            $company->setEmailValidated(false);
            $token = bin2hex(random_bytes(21));
            $company->setToken($token);
            $company->setConnected(1);
            $company->setDiscr('user');

            $company->setInscriptiondate(new \DateTime());
            $company->setActived(false);
            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            //$this->sendRegistrationMail($company->getEmail(), $company->getToken(), $mailer);
           /* $this->addFlash(
                'notice',
                'VOTRE INSCRIPTION A BIEN ÉTÉ ENREGISTRÉE !

                            Votre compte est en cours d’acceptation.

                            Un e-mail de validation d’inscription vous sera envoyé dans les plus brefs délais.

                            Vous ne trouvez pas votre mail de confirmation ?
                            Merci de vérifier si vous ne l’avez pas reçu parmi vos courriers indésirables ou spam

                            Nous sommes heureux de vous compter maintenant parmi nos entreprises et organisations référencées.

                            Merci de votre confiance !
                            Equipe gaea21 – Répertoire Vert'
            );*/
            return $this->redirectToRoute('homepage');
        }
        return $this->render('person/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/profile/particulier", name="personProfileShow")
     */
    public function showProfile(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $companiesFav=$this->getuser()->getCompanyFavs();
        $company = $this->getUser();
        if (explode('\\', $em->getClassMetadata(get_class($company))->getName())[2] == 'Person') {
            return $this->redirectToRoute('personProfile');
        }
        $form = $this->createForm(PersonType::class, NULL);
        if ($form->isSubmitted() && $form->isValid()) {
            $slugify = new Slugify();
            $slug=$slugify->slugify($company->getName());
            $company->setSlug($slug);
            $em->persist($company);
            $em->flush();
            return $this->redirectToRoute('companyProfile');
        }
        return $this->render('person/profile.html.twig', [
            'form' => $form->createView(),
            'company' => $company,
            'companiesFav'=>$companiesFav
        ]);
    }

    /**
     * @Route("/productsFavParticulier", name="productsFavParticulier")
     * @return
     */
    public function productsFav()
    {
        $em = $this->getDoctrine()->getManager();
        $productsFav = $em->getRepository(ProductFav::class)->findBy(['user' => $this->getUser()]);
        $products=new ArrayCollection();
        foreach($productsFav as $comp)
        {
            $products[]=$comp->getProductx();
        }
        return $this->render('person/productsFav.html.twig', [
            'products' => $products,
            'productsFav'=>$productsFav
        ]);
    }

    /**
     * @Route("/parametres/particulier", name="personSettings")
     */
    public function showSettings()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $company = $this->getUser();
        return $this->render('person/settings.html.twig', [
            'company' => $company
        ]);
    }

    /**
     * @Route("/MesEvenementsFavoris", name="eventsFavPerson")
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
        return $this->render('person/eventsFav.html.twig', [
            'events' => $events,
            'eventsFav'=>$eventsFav
        ]);
    }

    /**
     * @Route("/user/disable/person/{id}", name="personDisableItself")
     */
    public function companyDisableItself($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Person::class)->findOneBy(array('id' => $id));
        if ($company->isActived(true)) {
            $company->setActived(false);
            $em->flush();
            $this->addFlash(
                'notice',
                'Votre compte entreprise a été désactivé.
                Vous avez reçu un email de réactivation
                de votre compte entreprise.'
            );

            //$this->sendAccountReActivationMail($company->getEmail(), $company->getToken());

        }
        return $this->render('user/login.html.twig', [
            'company' => $company
        ]);
    }
}
