<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\GaeaUser;
use App\Entity\GetUser;
use App\Entity\Product;
use App\Repository\CompanyRepository;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle;
use Symfony\Bundle\FrameworkBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;
use Cocur\Slugify\Slugify;

use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\Common\Collections\ArrayCollection ;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use App\Entity\NewsLetterUser;
use App\Form\NewsletterType;
use App\Repository\NewsLetterUserRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;


class DefaultController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    /**
     * @Route("/{reactRouting}", name="index", priority="-1", defaults={"reactRouting": null}, requirements={"reactRouting"=".+"})
     */
    public function index(): Response
    {
        return $this->render('react.html.twig', [
        ]);
    }

    /**
     * @Route("/old-old", name="homepageold")
     */
    public function indexAction1(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'categories' => $this->getAlLCategories(),
        ]);
    }
    /**
     * @Route("/home/{role}", name="homepage")
     */
    public function indexAction(Request $request,$role)
    {
       // dd($this->getAlLCategories());
        return $this->render('welcome/home_entreprise.html.twig', [
            'role'=>$role,
            'categories' => $this->getAllCategories(),
        ]);
    }
    public function getAllCategories(){
        return $categories = $this->getDoctrine()->getRepository('App:Category')->findAll();
    }

    /**
     * @Route("/", name="home_inscriptionNewsletter", methods={"POST"})
     * 
     */
public function inscription( Request $request, EntityManager $em, SerializerInterface $serializer)
{
    
    $contenu = $request->getContent();
    $contenuDecode = json_decode($contenu,true);
    $nom = $contenuDecode['nom'];
    $prenom = $contenuDecode['prenom'];
    $ville = $contenuDecode['ville'];
    $mail = $contenuDecode['mail'];
    $code_postal = $contenuDecode['code_postal'];

    $newsletter = new NewsLetterUser();
    $newsletter->setNom($nom);
    $newsletter->setPrenom($prenom);
    $newsletter->setVille($ville);
    $newsletter->setMail($mail);
    $newsletter->setCodePostal($code_postal);
    $em = $this->getDoctrine()->getManager();
    $em->persist($newsletter);
    $em->flush();
     
    return $this->json(['status'=> 200,'message' => "Ok"]);

}



    /**
     * @Route("/recherche/{type}/{param}", name="repertorySearchParam", defaults={"param"="all"})
     */
    public function repertoireSearchAction(Request $request,$type,$param)
    {
        $companiesTitle="";
        $productsTitle="";
        $products="";
        $companies="";
        if($type=="entreprise"){
            if($param=="all"){
                $companies = $this->getDoctrine()->getRepository('App:Company')->findAll();
                $companiesTitle="Toutes les entreprises";
            }else{
                $companies = $this->getDoctrine()->getRepository('App:Company')->findByName($param);
                $companiesTitle="Entreprises trouvées";
            }
        }elseif($type=="produit"){

            if($param=="all"){
                $products = $this->getDoctrine()->getRepository('App:Product')->findAll();
                $productsTitle="Tous les produits";

            }else{
                $products = $this->getDoctrine()->getRepository('App:Product')->findByName($param);
                $productsTitle="Produits et services trouvés";

            }
        }else{
            throw $this->createNotFoundException("Cette route n'exsiste pas");
        }

        return $this->render('page/resultats_recherche.html.twig',[
            'productsTitle'=>$productsTitle,
            'companiesTitle'=>$companiesTitle,
            'products'=>$products,
            'companies'=>$companies
        ]);
    }

    /**
     * @Route("/DerniersInscrits/{id}", name="DerniersInscrits")
     */
    public function repertoireAction(Request $request)
    {
        // avant modif de la route y'avait ça en plus ,defaults={"param"="latest","action"="none"}
        $em = $this->getDoctrine()->getManager();
        $months = $request->get('id');
        $companiesSince = New ArrayCollection() ;

        if($months==1){
            $companiesSince = $em->getRepository(Company::class)->findCompaniesThisMonth() ;
        }
        else if($months>1){
            $format = 'Y-m-d';
            $today = date("Y-m-d");
            $vardate = \DateTime::createFromFormat($format,$today); // on recup la date daujourdhui
            date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
            $companiesSince = $em->getRepository(Company::class)->findCompaniesSince($vardate) ;
        }

        $companiesToday = $em->getRepository(Company::class)->findCompaniesToday() ;
        $companiesWeek = $em->getRepository(Company::class)->findCompaniesThisWeek() ;

        return $this->render('page/derniersinscrits.html.twig',[
            'categories' => $this->getAllCategories(),
            'companiesSince'=>$companiesSince,
            'companiesToday'=>$companiesToday,
            'companiesWeek'=>$companiesWeek,
            'months'=>$months,
        ]);
    }

    /**
     * @Route("/DerniersProduits/{id}", name="DerniersProduits")
     */
    public function repertoireProduitsAction(Request $request)
    {
        // avant modif de la route y'avait ça en plus ,defaults={"param"="latest","action"="none"}
        $em = $this->getDoctrine()->getManager();
        $months = $request->get('id');
        $productsSince = New ArrayCollection() ;

        if($months==1){
            $productsSince = $em->getRepository(Product::class)->findProductsThisMonth() ;
        }
        elseif($months>1){
            $format = 'Y-m-d';
            $today = date("Y-m-d");
            $vardate = \DateTime::createFromFormat($format,$today); // on recup la date daujourdhui
            date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
            $productsSince = $em->getRepository(Product::class)->findProductsSince($vardate) ;
        }

        $productsToday = $em->getRepository(Product::class)->findProductsToday() ;
        $productsWeek = $em->getRepository(Product::class)->findProductsThisWeek() ;

        return $this->render('page/derniersproduits.html.twig',[
            'categories' => $this->getAllCategories(),
            'productsSince'=>$productsSince,
            'productsToday'=>$productsToday,
            'productsWeek'=>$productsWeek,
            'months'=>$months,
        ]);
    }

    /**
     * @Route("/VentesRepertoireVert", name="VentesRepertoireVert")
     */
    public function VentesRepertoireVert(Request $request)
    {
        return $this->render('page/ventesRV.html.twig');
    }

    /**
     * @Route("/Impacts", name="Impacts")
     */
    public function impacts(Request $request)
    {
        return $this->render('page/impact.html.twig');
    }

    /**
     * @Route("/VentesEncartPub", name="VentesEncartPub")
     */
    public function VentesEncartPub(Request $request)
    {
        return $this->render('page/ventesEncartPub.html.twig');
    }

    /**
     * @Route("/mentions-legales", name="mentions-legales")
     */
    public function mentionsLegales(): Response
    {
        return $this->render('mentions_legales.html.twig');
    }


    /**
     * @Route("/404", name="404")
     */
    public function page404(): Response
    {
        return $this->render('page_404.html.twig');
    }



}
