<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\CompanyFav;
use App\Entity\CompanyFavoris;
use App\Entity\Event;
use App\Entity\EventFav;
use App\Entity\Marchandise;
use App\Entity\Product;
use App\Entity\ProductFav;
use App\Entity\Service;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\CompanyType;
use App\Form\UserType;
use Cocur\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }



    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $helper = $this->get('security.authentication_utils');

        return $this->render(
            'user/login.html.twig',
            array(
                'last_username' => $helper->getLastUsername(),
                'error' => $helper->getLastAuthenticationError(),
            )
        );
    }

    /**
     * @Route("/login_check", name="security_login_check")
     */
    public function loginCheckAction()
    {
        /*
        $repository = $this->getDoctrine()
          ->getManager()
          ->getRepository('OCPlatformBundle:Advert');
          $user = $em->getRepository(User::class)->findOneBy(['slug' => $slug]);
            if (!$user.) {
                throw $this->createNotFoundException('produit non trouvée');
            }
            return $this->render('product/show.html.twig', [
                'product' => $product
            ]);
            */
    }

    /**
     * @Route("/administration", name="adminDashboard")
     */
    public function showAdmin()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        return $this->render('user/admindashboard.html.twig');

    }

    /**
     * @Route("/administration/user/add",name="userAdminAdd")
     */
    public function add(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $admin = new User();
        $form = $this->createForm(UserType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new persons password
            //$encoder = $this->get('security.password_encoder');
            //$password = $encoder->encodePassword($admin, $admin->getPlainPassword());
            $password = 'temporarypassword';
            $admin->setPassword($password);

            // Set their role
            $admin->setRole('ROLE_ADMIN');


            $admin->setActived(false);
            $admin->setEmailValidated(false);

            $token = bin2hex(random_bytes(21));
            $admin->setToken($token);


            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();
            $this->sendRegistrationMail($admin->getEmail(), $admin->getToken());

            $this->addFlash(
                'notice',
                'Un email à été envoyé pour valider l\'email'
            );

            return $this->redirectToRoute('adminDashboard');
        }

        return $this->render('user/add.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/administration/users/",name="userAdminManage")
     */
    public function manage(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('App:User')->findBy(['role' => 'ROLE_ADMIN']);
        return $this->render('user/manage.html.twig', [
            'users' => $users,
        ]);

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }

    /**
     * @Route("/validation/{email}/{token}", name="validationMail")
     */
    public function validation($email, $token)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('App:User')->findOneBy(array('email' => $email));

        if ($user && $user->getToken() == $token) {

            $user->setEmailValidated(true);
            $em->flush();
            $this->addFlash(
                'notice',
                'Adresse email validée'
            );
        }
        return $this->redirectToRoute('login');

    }

    /**
     * @Route("/administration/user/delete/{id}", name="userAdminDelete")
     */
    public function delete($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('App:User')->findOneBy(array('id' => $id));
        if ($user and $user->getRole() == "ROLE_ADMIN") {
            //DELETE
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('userAdminManage');

    }

    public function sendRegistrationMail($email, $token)
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
            $this->get('mailer')->send($message);
        } catch (\Swift_TransportException $e) {
            echo $e->getMessage();
        }
        return $this->redirectToRoute('login');
    }
    /**
     * @Route("/user/reset-password", name="userPreResetPassword")
     */
    public function preresetPassword(Request $request){


        if ($request->getMethod() == "POST") {
            $email=$request->request->get('_email');
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('App:User')->findOneBy(array('email' => $email));
            $this->sendResetPasswordMail($user->getEmail(), $user->getToken());

            $this->addFlash(
                'success',
                'Un lien vous est envoyé par email'
            );

        }
        return $this->render('user/preresetpassword.html.twig');
    }
    /**
     * @Route("/user/reset-password/{email}/{token}", name="userResetPassword")
     */
    public function resetPassword(Request $request,$email,$token){

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);
        $plainpassword = substr(str_shuffle(strtolower(sha1(rand() . time() . "awpovdhiwsdovos"))),0, 10);

        $encoder = $this->get('security.password_encoder');
        $password = $encoder->encodePassword($user,$plainpassword);
        $user->setPassword($password);
        $em->flush();

        $this->sendNewPasswordMail($user->getEmail(), $plainpassword);

        $this->addFlash(
            'notice',
            'Un mail vous est envoyé avec votre mot de passe'
        );
        //return $this->render('user/login.html.twig');
        return $this->redirectToRoute('login');
    }
    public function sendResetPasswordMail($email, $token)
    {
        $message = (new \Swift_Message('Reinitialiser votre mot de passe'))
            ->setFrom('no_reply@repertoirevert.org')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'emails/resetpassword.html.twig',
                    [
                        'email' => $email,
                        'token' => $token,
                    ]
                ),
                'text/html'
            );

        try {
            $this->get('mailer')->send($message);
        } catch (\Swift_TransportException $e) {
            echo $e->getMessage();
        }
    }
    public function sendNewPasswordMail($email,$password)
    {
        $message = (new \Swift_Message('Nouveau mot de passe'))
            ->setFrom('no_reply@repertoirevert.org')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'emails/newpassword.html.twig',
                    [
                        'email' => $email,
                        'password' => $password,
                    ]
                ),
                'text/html'
            );

        try {
            $this->get('mailer')->send($message);
        } catch (\Swift_TransportException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @Route("/addProductFavoris/{slug}", name="addProductFavoris")
     */
    public function addProductFavoris($slug)
    {

        $em = $this->getDoctrine()->getManager();
        $date=(new \DateTime());
        $user=$this->getUser();
        $product = $em->getRepository(Product::class)->findOneBy(['slug' => $slug]);
        $PFav = $em->getRepository(ProductFav::class)->findOneBy(['user' => $user,'product' => $product]);

        $ProductFav= new  ProductFav();
        $ProductFav->setUser($user);
        $ProductFav->setDate($date);
        $ProductFav->setProduct($product);
        $em->persist($ProductFav);
        $em->flush();


        $n=1;

        if ($product instanceof Marchandise) {
            $marchandise = $em->getRepository(Marchandise::class)->findOneBy(['slug' => $slug]);

            return $this->render('product/FicheProduit.html.twig', [
                'product' => $product,
                'marchandise' => $marchandise,

                'n'=>$n

            ]);
        }
        else{
            $service = $em->getRepository(Service::class)->findOneBy(['slug' => $slug]);

            return $this->render('services/FicheService.html.twig', [
                'product' => $product,
                'service'=>$service,
                'n'=>$n

            ]);
        }


    }

    /**
     * @Route("/addCompanyFavoris/{slug}", name="addCompanyFavoris")
     */
    public function addCompanyFavoris($slug)
    {

        $em = $this->getDoctrine()->getManager();
        $date=(new \DateTime());
        $user=$this->getUser();
        $company = $em->getRepository(Company::class)->findOneBy(['slug' => $slug]);
        $companyFav= new  CompanyFav();
        $companyFav->setUser($user);
        $companyFav->setDate($date);
        $companyFav->setCompany($company);
        $em->persist($companyFav);
        $em->flush();


        $n=1;
        $products = $em->getRepository(Product::class)->findBy( array('company' => $company) );




            return $this->render('company/entreprise.html.twig', [
                'company' => $company,
                'products'=>$products,
                'n'=>$n

            ]);



    }
    /**
     * @Route("/addEventFavoris/{id}", name="addEventFavoris")
     */
    public function addEventFavoris($id)
    {

        $em = $this->getDoctrine()->getManager();
        $date=(new \DateTime());
        $user=$this->getUser();
        $event = $em->getRepository(Event::class)->findOneBy(['id' => $id]);
        $eventFavory = $em->getRepository(EventFav::class)->findOneBy(['user' => $user,'event' => $event]);
        if($eventFavory==null)
        {
            $eventFav= new  EventFav();
            $eventFav->setUser($user);
            $eventFav->setDate($date);
            $eventFav->setEvent($event);
            $em->persist($eventFav);
            $em->flush();
        }



        $n=1;
        $events = $em->getRepository(Event::class)->findBy( ['id' => $id] );




        return $this->render('event/show.html.twig', [
            'event' => $event,
            'events'=>$events,
            'n'=>$n

        ]);



    }

    /**
     * @Route("/deleteCompanyFavoris/{slug}", name="deleteCompanyFavoris")
     */
    public function deleteCompanyFavoris($slug)
    {



        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findOneBy(['slug' => $slug]);
        $user=$this->getUser();
        $companyFav = $em->getRepository(CompanyFav::class)->findOneBy( array('user'=>$user,'company' => $company));
        if($eventFavory =!null) {
            $em->remove($companyFav);
            $em->flush();

            $products = $em->getRepository(Product::class)->findBy(array('company' => $company));
            $n = 0;
        }
        return $this->render('company/entreprise.html.twig', [

            'company' => $company,
            'products'=>$products,
            '$companyFav'=>$companyFav,
            'n'=>$n

        ]);

    }

    /**
     * @Route("/deleteEventFavoris/{id}", name="deleteEventFavoris")
     */
    public function deleteEventFavoris($id)
    {



        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Event::class)->findOneBy(['id' => $id]);
        $user=$this->getUser();
        $eventFav = $em->getRepository(EventFav::class)->findOneBy( array('user'=>$user,'event' => $event));
        $em->remove($eventFav);
        $em->flush();

        $n=0;

        return $this->render('event/show.html.twig', [

            'event' => $event,

            'eventFav'=>$eventFav,
            'n'=>$n

        ]);

    }

    /**
     * @Route("/deleteProductFavoris/{slug}", name="deleteProductFavoris")
     */
    public function deleteProductFavoris($slug)
    {



        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->findOneBy(['slug' => $slug]);
        $user=$this->getUser();
        $productFav = $em->getRepository(ProductFav::class)->findOneBy( array('user'=>$user,'product' => $product));
        $em->remove($productFav);
        $em->flush();


        $n=0;

        if ($product instanceof Marchandise) {
            $marchandise = $em->getRepository(Marchandise::class)->findOneBy(['slug' => $slug]);

            return $this->render('product/FicheProduit.html.twig', [
                'product' => $product,
                'marchandise' => $marchandise,
                'n'=>$n

            ]);
        }
        else{
            $service = $em->getRepository(Service::class)->findOneBy(['slug' => $slug]);

            return $this->render('services/FicheService.html.twig', [
                'product' => $product,
                'service'=>$service,
                'n'=>$n

            ]);
        }

    }

    /**
     * @Route("/CompanyEvents", name="CompanyEvents")
     * @return
     */
    public function CompanyEvents()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository(Event::class)->findBy(['user' => $this->getUser()]);

        return $this->render('company/CompanyEvents.html.twig', [
            'events' => $events

        ]);
    }

    /**
     * @Route("/listAccount", name="list_account", methods="GET")
     */
    public function listAccount(HttpClientInterface $client)
    {
        $response = $client->request(
            'GET',
            'https://gaea21user.sustlivprogram.org/apictrl/company/getInactifUsers', [
            //'https://127.0.0.1:8001/apictrl/company/getInactifUsers',[
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);

        $content = $response->getContent();
        $allPlatformUsers = json_decode($content);

        // On doit filtrer les utilisateurs Gaea pour ne garder que ceux inscrits sur le Répertoire Vert
        $rvUsers = $this->getDoctrine()->getRepository('App:User')->findUserIds();
        $filteredUsers = array();

        foreach($rvUsers as $rvUser) {
            foreach ($allPlatformUsers as $user) {

                if ($user->id == $rvUser['gaeaUserId']) {
                    $filteredUsers[] = $user;

                }

            }
        }


        return $this->render('company/listAccount.html.twig', [
            'users' => $filteredUsers
        ]);;

    }

    /**
     * @Route("/resetPassword/{token}")
     * @return
     */
    public function resetGaeaPassword($token)
    {

        return $this->render('user/resetGaeaPassword.html.twig', [
            'token' => $token

        ]);
    }

    /**
     * @Route("/accountConfirmed/{token}", name="accountActivated")
     * Méthode utilisée pour la confirmation de compte à l'inscription (token utilisé) ET la réactivation du compte RépertoireVert (token non utilisé)
     * @return
     */
    public function confirmGaeaAccount($token = false, HttpClientInterface $client)
    {
        if($token){
            $response = $client->request(
                'POST',
                'https://gaea21user.sustlivprogram.org/apictrl/confirm/'.$token, [
                //'json' => []
            ]);
        }

        // Dans le cas de la réactivation de compte, on affiche juste le template sans faire la requete CURL ^
        return $this->render('user/succes_compte_confirme.html.twig');
    }

}
