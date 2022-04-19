<?php

namespace App\Controller;


use App\Entity\ProductClick;
use App\Entity\Subcategory;
use App\Service\FileUploader;
use App\Service\RegisteredToNewsletterChecker;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\CompanyFav;
use App\Entity\CompanyFavoris;
use App\Entity\ProductFav;
use App\Entity\Visite;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CompanyFavorisRepository;
use App\Repository\VisiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Company;
use App\Repository\CompanyRepository;
use App\Entity\Category;
use App\Entity\Marchandise;
use App\Entity\NewsLetterUser;
use App\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Repository\CategoryRepository;

use Symfony\Component\Form\FormError;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Form\DesactivateCompanyType;
use App\Service\CryptService;
// use Doctrine\ORM\EntityManagerInterface as EntityManager;

class CompanyController extends AbstractController
{
    private $em;
    
    private $client; 

    public function __construct(EntityManagerInterface $em, HttpClientInterface $client)
    {
        $this->client = $client;
        $this->em = $em;
    }

    /**
     * @Route("/company", name="company")
     */
    public function index(): Response
    {
        return $this->render('company/index.html.twig', [
            'controller_name' => 'CompanyController',
        ]);
    }

    /**
     * @Route("/redirectRegister/", name="redirect_inscription")
     */
    public function setGaeaUserId(Request $request,SerializerInterface $serializer,CategoryRepository $catrep, FileUploader $fileUploader)
    {
        $em = $this->getDoctrine()->getManager();
        //$contenu = $request->getContent();
        $contenu = $request->request->get('objArr');
        $contenuDecode = json_decode($contenu,true);
        //$company = $serializer->deserialize($contenu, Company::class, 'json');
        $categories_name = $contenuDecode['categories'];
        //$categories_name = $request->request->get('objArr')['categories'];
        $categories = new ArrayCollection();
        foreach($categories_name as $category_name){
            $categories[] = $catrep->findOneBy(['name'=>$category_name]);
        }

        $gaeauserid = $contenuDecode['gaeaUserId'];
        $rue = $contenuDecode['street'];
        $name = $contenuDecode['name'];
        $ville = $contenuDecode['city'];
        $raisonsociale = $contenuDecode['socialreason'];
        $codepostale = $contenuDecode['postcode'];
        $canton = $contenuDecode['region'];
        $pays = $contenuDecode['country'];
        $latitude = $contenuDecode['latitude'];
        $longitude = $contenuDecode['longtitude'];
        $tel = $contenuDecode['phone'];
        $site = $contenuDecode['urlwebsite'];
        $linkedin = $contenuDecode['urllinkedin'];
        $facebook = $contenuDecode['urlfacebook'];
        $twitter = $contenuDecode['urltwitter'];
        $débutactivité = $contenuDecode['startingdate'];
        $certif = $contenuDecode['certification'];
        $vision = $contenuDecode['vision'];
        $zoneinfluence = $contenuDecode['influencezone'];
        $descritpion = $contenuDecode['description'];
        $evaluation = $contenuDecode['wantevaluation'];
        $niveau = $contenuDecode['niveau'];
        $file = $request->files->get('file');
        $nom = $contenuDecode['nom'];
        $prenom = $contenuDecode['prenom'];


        $Setcompany = new Company();

        if(!is_null($file)){

            $path = $this->getParameter('companies');
            $filename = $fileUploader->upload($file, $path);
            $Setcompany->setImage($filename);
        }

        $Setcompany->setName($name);
        $Setcompany->setStreet($rue);
        $Setcompany->setCity($ville);
        $Setcompany->setsocialreason($raisonsociale);
        $Setcompany->setPostcode($codepostale);
        $Setcompany->setRegion($canton);
        $Setcompany->setCountry($pays);
        $Setcompany->setPhone($tel);
        $Setcompany->setUrlwebsite($site);
        $Setcompany->setUrllinkedin($linkedin);
        $Setcompany->setUrlfacebook($facebook);
        $Setcompany->setUrltwitter($twitter);
        $Setcompany->setstartingdate(new \DateTime($débutactivité));
        $Setcompany->setCertification($certif);
        $Setcompany->setLastname($nom);
        $Setcompany->setFirstname($prenom);
        
        foreach($categories as $cat){
            $Setcompany -> addCategory($cat);
        }

        $Setcompany->setVision($vision);
        $Setcompany->setInfluencezone($zoneinfluence);
        $Setcompany->setDescription($descritpion);
        $Setcompany->setWantevaluation($evaluation);
        $Setcompany->setLatitude($latitude);
        $Setcompany->setLongtitude($longitude);


        $Setcompany->setgaeaUserId($gaeauserid);
        $Setcompany->setRole('ROLE_COMPANY');
        $slugify = new Slugify();
        $slug = $slugify->slugify($name);
        $Setcompany->setSlug($slug);
        $Setcompany->setActivated(true);
        $Setcompany->setActived(true);
        $Setcompany->setEmailValidated(false);
        $token = bin2hex(random_bytes(21));
        $Setcompany->setToken($token);
        $Setcompany->setInscriptiondate(new \DateTime());
        $Setcompany->setNiveau($niveau);
        $em = $this->getDoctrine()->getManager();
        $em->persist($Setcompany);
       


        //enregistrement a la newsletter
        if($contenuDecode['newsletter']) {

            $existingNewsletterUser = $em->getRepository(NewsLetterUser::class)->findOneBy(['mail' => $contenuDecode['mail']]);
            if($existingNewsletterUser){
                $em->remove($existingNewsletterUser);
                //$existingNewsletterUser->setUserId($Setcompany);
            }
            $newsletterUser = new NewsLetterUser();
            $newsletterUser->setUserId($Setcompany);
            $newsletterUser->setNom($nom);
            $newsletterUser->setPrenom($prenom);
            $newsletterUser->setCodePostal($codepostale);
            $newsletterUser->setVille($ville);
            $newsletterUser->setMail($contenuDecode['mail']);


            $em->persist($newsletterUser);
        }

        $em->flush(); 

        return $this->json(['status'=> 200,'message' => "Ok"]);
    }

    /**
     * @Route("/deactivateAccount/", name="deactivate_account")
     */
    public function deactivateAccount()
    {
        
        $Setcompany = $this->getUser();

        //$Setcompany->actived = false;
        
        $em = $this->getDoctrine()->getManager();
        $em->flush(); 
        return $this->json(['status'=> 200,'message' => "Ok"]);
    }


    /**
     * @Route("/redirectModify/", name="redirect_modification")
     */
    public function modifgaeauser(Request $request, CategoryRepository $catrep, FileUploader $fileUploader) {
        //$contenu = $request->getContent();
        $contenu = $request->request->get('objArr');
        $contenuDecode = json_decode($contenu,true);
        //$company = $serializer->deserialize($contenu, Company::class, 'json');

        /*$categories_name = $contenuDecode['categories'];

        $categories = new ArrayCollection();
        foreach($categories_name as $category_name){
            $categories[] = $catrep->findOneBy(['name'=>$category_name]);
        }*/
        $rue = $contenuDecode['street'];
        $name = $contenuDecode['name'];
        $ville = $contenuDecode['city'];
        $raisonsociale = $contenuDecode['socialreason'];
        $codepostale = $contenuDecode['postcode'];
        $canton = $contenuDecode['departement'];
        $pays = $contenuDecode['country'];
        $tel = $contenuDecode['phone'];
        $site = $contenuDecode['urlwebsite'];
        $linkedin = $contenuDecode['urllinkedin'];
        $facebook = $contenuDecode['urlfacebook'];
        $twitter = $contenuDecode['urltwitter'];
        $débutactivité = $contenuDecode['startingdate'];
        $certif = $contenuDecode['certification'];
        $vision = $contenuDecode['vision'];
        $zoneinfluence = $contenuDecode['influencezone'];
        $descritpion = $contenuDecode['description'];
        $evaluation = $contenuDecode['wantevaluation'];
        $latitude = $contenuDecode['latitude'];
        $longitude = $contenuDecode['longtitude'];
        $niveau = $contenuDecode['niveau'];
        $lastname = $contenuDecode['nom'];
        $firstname = $contenuDecode['prenom'];
        $file = $request->files->get('file');

        $Setcompany = $this->getUser();
        /*$currentCategories = $Setcompany->getCategories();
        foreach($currentCategories as $cat){
            $Setcompany -> removeCategory($cat);
        }*/

        if(!is_null($file)){
            $path = $this->getParameter('companies');
            $filename = $fileUploader->upload($file, $path);
            $Setcompany->setImage($filename);
        }


        $Setcompany->setName($name);
        $Setcompany->setStreet($rue);
        $Setcompany->setCity($ville);
        $Setcompany->setsocialreason($raisonsociale);
        $Setcompany->setPostcode(intval($codepostale));
        $Setcompany->setRegion($canton);
        $Setcompany->setCountry($pays);
        $Setcompany->setPhone($tel);
        $Setcompany->setUrlwebsite($site);
        $Setcompany->setUrllinkedin($linkedin);
        $Setcompany->setUrlfacebook($facebook);
        $Setcompany->setUrltwitter($twitter);
        $Setcompany->setstartingdate(new \DateTime($débutactivité));
        $Setcompany->setCertification($certif);
        $Setcompany->setLatitude($latitude);
        $Setcompany->setLongtitude($longitude);
        $Setcompany->setVision($vision);
        $Setcompany->setInfluencezone($zoneinfluence);
        $Setcompany->setDescription($descritpion);
        $Setcompany->setWantevaluation($evaluation);
        $Setcompany->setNiveau($niveau);
        $Setcompany->setLastName($lastname);
        $Setcompany->setFirstName($firstname);
        /*foreach($categories as $cat){
            $Setcompany -> addCategory($cat);
        }*/

        $em = $this->getDoctrine()->getManager();
        $em->flush(); 
        return $this->json(['status'=> 200,'message' => "Ok"]);
    }

    /**
     * @Route("/redirectModifyCategories/", name="redirect_modification_cat")
     */
    public function modifcategories(Request $request, CategoryRepository $catrep) {

        //$contenu = $request->request->get('objArr');
        $contenu = $request->getContent();
        $contenuDecode = json_decode($contenu,true);

        $categories_name = $contenuDecode['categories'];
        $categories = new ArrayCollection();
        foreach($categories_name as $category_name){
            $categories[] = $catrep->findOneBy(['name'=>$category_name]);
        }

        $Setcompany = $this->getUser();
        $currentCategories = $Setcompany->getCategories();
        foreach($currentCategories as $cat){
            $Setcompany -> removeCategory($cat);
        }

        foreach($categories as $cat){
            $Setcompany -> addCategory($cat);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        //return $this->redirectToRoute('companyProfileShow');
        //return $this->redirect($this->generateUrl('companyProfileShow'));
        return $this->json(['status'=> 200,'message' => "Ok"]);
        /*$company = $this->getUser();
        $categories = $this->em->getRepository(Category::class)->findAll();
        return $this->render('company/profile.html.twig', [
            'company' => $company,
            'categories' => $categories,
        ]);*/
    }


    public function findCatByName($name){
        $em = $this->getDoctrine()->getManager();
        $category = $em
                    ->getRepository(Category::class)
                    ->findBy(['name'=>$name]);
        return($category);
    }

    /**
     * @Route("/inscription-entreprise/", name="companyRegister")
     */
    public function registerAction(Request $request)
    {
        $categories = $this->em->getRepository(Category::class)->findAll();

        foreach($categories as $category)
        {
            foreach ($category->getSubcategories() as $subcat)
            {
                $category->addSubcategory($subcat);
            }
        }

        $intYear = idate("Y");

        return $this->render('company/register.html.twig',[
            'categories'=>$categories,
            'currentYear' => $intYear
        ]);
    }

    /**
     * @Route("/checklogin", name="checklogin")
     */
    public function checklogin() {
        $loggedIn = $this->isGranted('IS_AUTHENTICATED_FULLY');
        return $this->json(['loggedIn' => $loggedIn]);
    }


    /**
     * @Route("/entreprise/{slug}", name="companyShow")
     */
    public function show($slug)
    {



        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findOneBy(['slug' => $slug]);
        $date=(new \DateTime());
        $visit = $em->getRepository(Visite::class)->findOneBy( array('companySlug' => $slug, 'date' => $date) );


        if ($visit==null):
            $visite = new Visite();

            $visite->setDate($date);
            $visite->setCompanySlug($slug);
            $visite->setNumber(1);
            $em->persist($visite);
            $em->flush();
        else :

            $visit->setNumber($visit->getNumber()+1);
            $em->persist($visit);
            $em->flush();

        endif;
        $products = $em->getRepository(Product::class)->findBy( array('company' => $company) );

        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $em = $this->getDoctrine()->getManager();
            $company = $em->getRepository(Company::class)->findOneBy( array('slug' => $slug ) );
            $user=$this->getUser();
            $companyFav = $em->getRepository(CompanyFav::class)->findOneBy( array('user' => $user,'company' => $company ) );

            if($companyFav == null)
            {
                $n=0;

            } else {
                $n=1;

            }


        } else {
            $n=3;

        }





        return $this->render('company/entreprise.html.twig', [

            'company' => $company,
            'visit' => $visit,
            'products'=>$products,
            'n'=>$n

        ]); 

    }



    /**
     * @Route("/product2/{id}", name="companyShowFromId")
     */
    public function showFromId($id)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findOneBy(['id' => $id]);
        $em = $this->getDoctrine()->getManager();
        $date=(new \DateTime());
        $visit = $em->getRepository(Visite::class)->findOneBy( array('companySlug' => $company->getSlug(), 'date' => $date) );


        if ($visit==null):
            $visite = new Visite();

            $visite->setDate($date);
            $visite->setCompanySlug($company->getSlug());
            $visite->setNumber(1);
            $em->persist($visite);
            $em->flush();
        else :

            $visit->setNumber($visit->getNumber()+1);
            $em->persist($visit);
            $em->flush();

        endif;
        $products = $em->getRepository(Product::class)->findBy( array('company' => $company) );

        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $em = $this->getDoctrine()->getManager();
            $company = $em->getRepository(Company::class)->findOneBy( array('slug' => $company->getSlug() ) );
            $user=$this->getUser();
            $companyFav = $em->getRepository(CompanyFav::class)->findOneBy( array('user' => $user,'company' => $company ) );


            if($companyFav == null)
            {
                $n=0;

            } else {
                $n=1;

            }


        } else {
            $n=3;

        }


        return $this->render('company/entreprise.html.twig', [

            'company' => $company,
            'visit' => $visit,
            'products'=>$products,
            'n'=>$n

        ]);

    }


    public function showProducts()
    {
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $marchandises = $this->getDoctrine()
            ->getRepository('App:Marchandise')
            ->createQueryBuilder('p')
            ->andWhere('p.company = :id')
            ->setParameter('id', $this->getUser()->getId())
            ->getQuery()
            ->getArrayResult();
        dump($marchandises);
        return $this->render('product/manage.html.twig', [
            'marchandises' => $marchandises
        ]);
    }

    /**
     * @Route("/profile/entreprise", name="companyProfileShow")
     */
    public function showProfile(Request $request)
    {
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $company = $this->getUser();

        $categories = $this->em->getRepository(Category::class)->findAll();

        $subcategories = $em->getRepository(Subcategory::class)->findByCompany($company);

        if (explode('\\', $em->getClassMetadata(get_class($company))->getName())[2] == 'Person') {
            return $this->redirectToRoute('personProfile');
        }
        foreach ($company->getCompanyFavCompanies() as $fav) {
            $company->addCompanyFavCompany($fav);
        }
        return $this->render('company/profile.html.twig', [
           'company' => $company,
            'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }

    /**
     * @Route("/activationProfil/{gaeaid}/", name="activationProfil")
     */
    public function activation(Request $request)
    {
        $msg = "Erreur" ;
        $gaeaid = $request->get('gaeaid');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)-> findOneBy(array('gaeaUserId' => $gaeaid));
        if($user != null ){
            $rep = true ;
            $rep2 = false ;
            $user -> setActived($rep);
            $msg = "Réussite !" ;
        }
        return new JsonResponse(['userId'=> $user->getId(),'userActivated'=> $user->getActived() ,'gaeaId' => $gaeaid,'message'=>$msg]); 
    }

    /**
     * @Route("/parametres/entreprise", name="compagnySettings")
     */
    public function showSettings(Request $request, MailerInterface $mailer, RegisteredToNewsletterChecker $registeredToNewsletterChecker)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $company = $this->getUser();
        $email = $request->getSession()->get('email');
        $categories = $this->em->getRepository(Category::class)->findAll();
        $intYear = idate("Y");
        $registeredToNewsletter = $registeredToNewsletterChecker->check();

        $desactivateForm = $this->createForm(DesactivateCompanyType::class);
        $desactivateForm->handleRequest($request);
        if($desactivateForm->isSubmitted()) {
            if($desactivateForm->isValid()){
                $emailForm = $desactivateForm->get('email')->getData();
                if($emailForm === $email){
                        $passwordForm = $desactivateForm->get('password')->getData();
                        $encryptedPassword = md5($passwordForm);
                        $response = $this->client->request(
                            'POST', 
                            'https://gaea21user.sustlivprogram.org/apictrl/login', 
                            [
                                'json' => [
                                    'email' => $emailForm, 
                                    'password' => $encryptedPassword
                                ],
                            ] 
                        );
                        $decodedPayload = $response->toArray();
                        if(isset($decodedPayload['id'])){
                            $company->setActivated(false);  
                            $this->em->flush();
                            $cryptService = new CryptService();
                            $encryptString = $cryptService->encrypt($company->getId());
                            $url = $this->generateUrl('companyActivate',  ['hash' => $encryptString]);

                            // envoyer par mail http://localhost/company/activate/{encryptString}
                            $activateEmail = (new TemplatedEmail())
                                ->from('no-reply@repertoirevert.org')
                                ->to(new Address($email))
                                ->subject('A CONSERVER - Désactivation de votre compte Répertoire Vert')
                                ->htmlTemplate('emails/re-activation.html.twig')
                                ->context([
                                    'url' => 'https://repertoirevert.org'.$url,
                                    //'url' => 'https://127.0.0.1:8000'.$url,
                                ]);
                            // A REACTIVER QUAND L'ENVOI DE MAIL MARCHERA SUR LE SERVEUR
                            //$mailer->send($activateEmail);

                            return $this->redirectToRoute('logout');
                        } else{
                            $desactivateForm->addError(new FormError($decodedPayload['message']));
                        }
                } else {
                    $desactivateForm->addError(new FormError('La désactivation du compte n\'est pas celle du compte actuel '));
                }
            }
        }

        if (!$company->getActivated()){
            die('Votre profile n\'est pas activé veuillez réactiver votre compte');
        
        }
        return $this->render('company/settings.html.twig', [
            'company' => $company,
            'email' => $email,
            'currentYear' => $intYear,
            'categories' => $categories,
            'desactivateForm'=> $desactivateForm->createView(),
            'registeredToNewsletter' => $registeredToNewsletter,
        ]);
    }
    /**
     * @Route("/company/active", name="active", methods={"POST"})
     */
    public function companyIsActive(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $id = $request->get('id');
            $company = $this->em->getRepository(Company::class)->findOneBy(['gaeaUserId'=> $id]);
            $jsonResponse = [
                'activated' => $company->getActivated(),
                'message' => $company->getActivated() ? '' : 'Le compte n\'est pas actif'
            ];
        } else {
            $jsonResponse = [
                'activated' => false,
                'message' => 'Opération non permise'
            ];
        }
        return new JsonResponse($jsonResponse);
    }

    /**
     * @Route("/company/activate/{hash}", name="companyActivate")
     */
    public function activateCompany($hash, Request $request)
    {
        $cryptService = new CryptService();
        $decryptString = $cryptService->decrypt($hash);
        $company = $this->em->getRepository(Company::class)->find($decryptString);
        if(isset($company)){
            $company->setActivated(true);
            $this->em->flush();
        }
        return $this->redirectToRoute('accountActivated');
        //K084a2pUeHc0b3d5bUg1U3lwRWkwdz09
    }

    /**
     * @Route("/administration/disable/company/{id}", name="companyDisable")
     */
    public function disableCompany($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('App:Company')->findOneBy(array('id' => $id));
        if ($request->getMethod() == "POST" and ($company->isActived(true))) {
            $company->setActived(false);
            $em->flush();
            $this->addFlash(
                'notice',
                'Entreprise désactivée'
            );
            return $this->redirectToRoute('companyManage');
        }
        return $this->render('company/disable.html.twig', [
            'company' => $company
        ]);
    }


    /**
     * @Route("/user/disable/company/{id}", name="companyDisableItself")
     */
    public function companyDisableItself($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('App:Company')->findOneBy(array('id' => $id));
        if ($company->isActived(true)) {
            $company->setActived(false);
            $em->flush();
            $this->addFlash(
                'notice',
                'Votre compte entreprise a été désactivé.
                Vous avez reçu un email de réactivation
                de votre compte entreprise.'
            );

            $this->sendAccountReActivationMail($company->getEmail(), $company->getToken());

        }
        return $this->render('user/login.html.twig', [
            'company' => $company
        ]);
    }
    /**
     * @Route("/user/enable/company/{id}", name="companyReEnableItself")
     */
    public function companyReEnableItself($email, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('App:Company')->findOneBy(array('email' => $email));
        if ($company->isActived(false)) {
            $company->setActived(true);
            $em->flush();
        }
        return $this->render('user/login.html.twig', [
            'company' => $company
        ]);
    }

    /**
     * @Route("/entreprise/recherche/{param}", name="companySearch")
     */
    public function search($param)
    {
        $em = $this->getDoctrine()->getManager();
        $companies = $em->getRepository(Company::class)->createQueryBuilder('p')
            ->andWhere('p.name LIKE :param')
            ->setParameter('param', '%' . $param . '%')
            ->getQuery();
        $companies = $companies->execute();
        return $this->render('company/search.html.twig', [
            'companies' => $companies
        ]);
    }

    /**
     * @Route("/administration/companies/",name="companyManage")
     */
    public function manage(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $companies = $em->getRepository('App:User')-> findBy(['role' => 'ROLE_COMPANY']);
        return $this->render('company/manage.html.twig', [
            'companies' => $companies,
        ]);
    }

    public function sendRegistrationMail($email, $token,\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Merci de valider votre adresse mail'))
            ->setFrom('no_reply@repertoirevert.org')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'emails/registration-company.html.twig',
                    [
                        'email' => $email,
                        'token' => $token
                    ]
                ),
                'text/html'
            );
        try {
            $mailer->send($message);
        } catch (\Swift_TransportException $e) {
            echo $e->getMessage();
        }
        return $this->redirectToRoute('login');
    }

    public function sendAccountReActivationMail($email, $token,\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Merci de valider votre adresse mail'))
            ->setFrom('no_reply@repertoirevert.org')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'emails/re-activation.html.twig',
                    [
                        'email' => $email,
                        'token' => $token
                    ]
                ),
                'text/html'
            );
        $mailer->send($message);
        /*
        try {
            $mailer->send($message);
        } catch (\Swift_TransportException $e) {
            echo $e->getMessage();
        }
        return $this->redirectToRoute('login');*/
    }

    /**
     * @Route("/addFavoris/{slug}", name="addFavoris")
     */
    public function addFavoris($slug)
    {

        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findOneBy(['slug' => $slug]);
        $date=(new \DateTime());
        $user=$this->getUser();
        $user->addCompanyFavs($company);


        $fav = $em->getRepository(CompanyFavoris::class)->findOneBy(['CompanySlug' => $slug, 'date' => $date] );

        if ($fav==null):
            $favo = new CompanyFavoris();
            $favo->setDate($date);
            $favo->setCompanySlug($slug);
            $favo->setNumber(1);
            $em->persist($favo);
            $em->flush();

        else :

            $fav->setNumber($fav->getNumber()+1);
            $em->persist($fav);
            $em->flush();

        endif;
        $products = $em->getRepository(Product::class)->findBy( array('company' => $company) );
        $n=1;


        return $this->render('company/show.html.twig', [
            'company' => $company,
            'products'=>$products,
            'fav'=>$fav,
            'n'=>$n
        ]);

    }

    /**
     * @Route("/deleteFavoris/{slug}", name="deleteFavoris")
     */
    public function deleteFavoris($slug)
    {



        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findOneBy(['slug' => $slug]);
        $user=$this->getUser();
        $date=(new \DateTime());
        $favoris = $em->getRepository(CompanyFavoris::class)->findOneBy( array('CompanySlug' => $company->getSlug(),'date'=>$date) );
        $user->deleteCompanyFavs($company);
        if($favoris->getNumber()==1)
        {
            $em->remove($favoris);
        }
        else
        {

            $favoris->setNumber($favoris->getNumber()-1);
        }

        $em->flush();

        $products = $em->getRepository(Product::class)->findBy( array('company' => $company) );
        $n=0;

        return $this->render('company/show.html.twig', [

            'company' => $company,
            'products'=>$products,
            'n'=>$n

        ]);

    }
    /**
     * @Route("/companiesFav", name="companiesFav")
     * @return
     */
    public function companiesFav()
    {
        $em = $this->getDoctrine()->getManager();
        $companiesFav = $em->getRepository(CompanyFav::class)->findBy(['user' => $this->getUser()]);
        $companies=new ArrayCollection();
        foreach($companiesFav as $comp)
        {
            $companies[]=$comp->getCompany();
        }
        return $this->render('company/companiesFav.html.twig', [
            'companies' => $companies,
            'companiesFav'=>$companiesFav
        ]);
    }
    /**
     * @Route("/Map/Entreprises", name="MapEntreprises")
     */
    public function MapCompanies()
    {

        $em = $this->getDoctrine()->getManager();
        $companies = $em->getRepository(Company::class)->findAll();

        return $this->render('page/map.html.twig',[
            'companies'=> json_encode($companies)
        ]);
    }

    /**
     * @Route("/tarifs-niveaux", name="tarifs-niveaux")
     */
    public function tarifsNiveaux(): Response
    {
        return $this->render('company/tarifs_niveaux.html.twig');
    }



        // function show companydetails
                     /**
     * @Route("/company/show/{companyId}/{subcategoryId}/{categoryId}", name="ShowCompanyDetails" , requirements={"id"="\d+"})
     * 
     */

    public function showDetails($companyId,$subcategoryId,$categoryId){
     


        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findOneBy(['id' => $companyId]);
        $categories = $this->em->getRepository(Category::class)->findAll();

        $subcategories = $em->getRepository(Subcategory::class)->findByCompany($company->getId());

        $date=(new \DateTime());

        $clicks = $em->getRepository(Visite::class)->findOneBy( array('company' => $company, 'date' => $date) );


        if ($clicks==null):
            $click = new Visite();

            $click->setDate($date);
            $click->setCompany($company);
            $click->setNumber(1);
            $em->persist($click);
            $em->flush();
        else :

            $clicks->setNumber($clicks->getNumber()+1);
            $em->persist($clicks);
            $em->flush();

        endif;

        return $this->render('company/showCompanyDetails.html.twig', [

            'company' => $company,
            'categories' => $categories,
            'categoryId' =>$categoryId,
            "subcategoryId" => $subcategoryId,
            'subcategories' => $subcategories


        ]); 
    }

    ///////////// Enregistrement des entreprises du fichiers excel dans la bdd + Envoi du mail de réinitialisation mdp //////////////
    /**
     * @Route("/upload-excel", name="xlsx")
     */
    public function getCompaniesfromExcel()
    {

        $fileFolder = __DIR__ . '/../../public/uploads/';  //choose the folder in which the uploaded file will be stored
        
        $spreadsheet = IOFactory::load($fileFolder."/entreprises-a-upload.xlsx"); // Here we are able to read from the excel file
        $row = $spreadsheet->getActiveSheet()->removeRow(1, 20); // I added this to be able to remove the first file line
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array
        //dd($sheetData);

        foreach ($sheetData as $Row) {
        //for($i=0; $i < 57; $i++){

            /*$name = $sheetData[$i]['A'];
            $description = $sheetData[$i]['B'];
            $email= $sheetData[$i]['C'];
            $tel = $sheetData[$i]['D'];*/
            $email= $Row['C'];
            $password = bin2hex(random_bytes(8));

            /////////// Ajout des entreprises du fichier excel dans la bdd => FAIT ///////////
            /*if($name != null) {

                $response = $this->client->request(
                    'POST',
                    'https://gaea21user.sustlivprogram.org/apictrl/add/gaeauser', [
                    'json' => [
                        'url' => 'rv',
                        'username' => $name,
                        'email' => $email,
                        'password' => $password,
                        'newpassword' => $password
                    ]
                ]);

                $content = $response->getContent();
                $content = json_decode($content);

                $company = new Company();

                $company->setName($name);
                $company->setStreet('');
                $company->setCity('');
                $company->setsocialreason('');
                $company->setPostcode('');
                $company->setRegion('');
                $company->setCountry('');
                $company->setPhone($tel);
                $company->setstartingdate(new \DateTime());

                $company->setVision('');
                $company->setInfluencezone('');
                if($description == null) {
                    $company->setDescription('');
                } else {
                    $company->setDescription($description);
                }
                $company->setWantevaluation(0);
                $company->setLatitude(0);
                $company->setLongtitude(0);


                $company->setgaeaUserId($content->id);
                $company->setRole('ROLE_COMPANY');
                $slugify = new Slugify();
                $slug = $slugify->slugify($name);
                $company->setSlug($slug);
                $company->setActivated(true);
                $company->setActived(true);
                $company->setEmailValidated(false);
                $token = bin2hex(random_bytes(21));
                $company->setToken($token);
                $company->setInscriptiondate(new \DateTime());
                $company->setNiveau('N.0');
                $em = $this->getDoctrine()->getManager();
                $em->persist($company);
                $em->flush();
            }*/


            /////////// Envoi du mail de réinitialisation de mdp //////////////
            if($email != null) {
                $response = $this->client->request(
                    'POST',
                    'https://gaea21user.sustlivprogram.org/apictrl/requestpassword', [
                    'json' => [
                        'url' => 'https://www.repertoirevert.org',
                        'email' => $email,
                    ]
                ]);
            }


        }

        return $this->json(['status'=> 200,'message' => "Ok"]);

    }


     

  
   
}
