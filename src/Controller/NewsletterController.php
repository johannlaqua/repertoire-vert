<?php

namespace App\Controller;

use App\Entity\NewsLetterUser;
use App\Form\NewsletterType;
use App\Repository\NewsLetterUserRepository;
use App\Service\RegisteredToNewsletterChecker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface as EntityManager;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class NewsletterController extends AbstractController
{

    private $client;


    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/newsletter/inscription", name="newsletter_inscription")
     *
     */
    public function inscription(Request $request, EntityManager $em)
    {
        $newsletter = new NewsLetterUser();

        if($this->isGranted('IS_AUTHENTICATED_FULLY')) {

            $user = $this->getUser();

            $newsletter->setNom($user->getLastname());
            $newsletter->setPrenom($user->getFirstname());
            $newsletter->setVille($user->getCity());
            $newsletter->setMail($request->getSession()->get('email'));
            $newsletter->setCodePostal($user->getPostcode());
            $newsletter->setUserId($user);

        } else {
            $contenu = $request->getContent();
            $contenuDecode = json_decode($contenu, true);

            $nom = $contenuDecode['nom'];
            $prenom = $contenuDecode['prenom'];
            $ville = $contenuDecode['ville'];
            $mail = $contenuDecode['mail'];
            $code_postal = $contenuDecode['code_postal'];

            $newsletterUser = $em->getRepository(NewsLetterUser::class)->findOneBy(['mail' => $mail]);

            if($newsletterUser){
                $em->remove($newsletterUser);
            }

            $newsletter->setNom($nom);
            $newsletter->setPrenom($prenom);
            $newsletter->setVille($ville);
            $newsletter->setMail($mail);
            $newsletter->setCodePostal($code_postal);
        }

        $em->persist($newsletter);
        $em->flush();


        return $this->json(['status' => 200, 'message' => "Ok"]);
    }


    /**
     * @Route("/newsletter/inscriptiontest", name="newsletter_inscription_test")
     *
     */
    public function testinscription()
    {
        return $this->render("newsletter/formulaire.html.twig", []);

    }

    /**
     * @Route("/newsletter/popup", name="newsletter_popup")
     *
     */
    public function popUp()
    {
        return $this->render("newsletter/popup.html.twig", []);
    }


    /**
     * @Route("/newsletter/checkRegistered", name="newsletter_registered")
     */
    function checkRegistered(RegisteredToNewsletterChecker $registeredToNewsletterChecker)
    {
        return $this->json(['registered' => $registeredToNewsletterChecker->check()]);

    }
}
