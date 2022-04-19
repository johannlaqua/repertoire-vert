<?php

namespace App\Controller;

use App\Entity\Ads;
use App\Entity\ForumAds;
use App\Entity\ProductAds;
use App\Entity\TarifAds;
use App\Entity\TarifAdsUser;
use App\Form\AdminAdsProduct;
use App\Form\AdminAdsType;
use App\Form\AdsType;
use App\Form\TarifAdsUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Subcategory;
use App\Form\CategoryType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use App\service\FileUploader;
use Troopers\AlertifyBundle\Helper\AlertifyHelper;


class AdsController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session, \Knp\Snappy\Pdf $knpSnappy)
    {
        $this->session = $session;
        $this->knpSnappy = $knpSnappy;
    }
    public function addAdAction(Request $request, AlertifyHelper $alertify)
    {
        $getUserStatus = $this->getUser()->getActived();
        if ($getUserStatus == false) {
            return $this->redirectToRoute('home');
        } else {


            $ads = new Ads();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(AdsType::class, $ads);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();


                $file = $ads->getPhoto();
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('post_directory'), $filename);
                $ads->setPhoto($filename);
                $ads->setPayed(false);
                $ads->setPrice(50);
                $ads->setCreator($this->getUser());
                $ads->setCreatedAt(new \DateTime('now'));
                $em->persist($ads);
                $em->flush();


                $alertify->congrat('Congratulation !');
                // if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                //  return new RedirectResponse('/');
            }

            return $this->render('ads/company/addAd.html.twig', array(
                "Form" => $form->createView()
            ));
        }
    }

    public function displaymyAds()
    {
        $availablePacks= $this->GetAllPacks();
$tarifsAds= $this->displayTarifsAds();
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $ads = $em->getRepository(Ads::class)
            ->createQueryBuilder('p')
            ->select("p, c")
            ->leftJoin('p.location', 'c')
            ->where('p.creator = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $total = $em->getRepository(Ads::class)

            ->createQueryBuilder('o')
            ->select('o')


            ->addSelect('SUM(o.price) AS total_sum')
            ->getQuery()
            ->getScalarResult();

        $total = $em->getRepository(Ads::class)

            ->createQueryBuilder('o')
            ->select('o')


            ->addSelect('SUM(o.price) AS total_sum')
            ->getQuery()
            ->getScalarResult();
        foreach ($total as $tot){
            $tot['total_sum'];
            $theTotal=$tot['total_sum'];
        }
        $this->session->set('adstotal', $theTotal);
        return $this->render('ads/company/displayAds.html.twig'
            , array(
                "ads" => $ads,
                "total"=>$total,
                "theTotal"=>$theTotal,
                "tarifsAds"=>$tarifsAds,
                "availablePacks"=>$availablePacks
            ));
    }


    public function displayAdsAdmin()
    {


        $em = $this->getDoctrine()->getManager();
        $ads = $this->getDoctrine()
            ->getRepository(TarifAdsUser::class)
            ->createQueryBuilder('p')
            ->select("p, c, u, x")
            ->leftJoin('p.adv', 'c')
            ->leftJoin('p.user', 'u')
            ->leftJoin('p.tarif', 'x')
            ->getQuery()
            ->getResult();


        return $this->render('ads/admin/allAds.html.twig'
            , array(
                "ads" => $ads
            ));
    }

    public function selectAdsPagesAdmin()
    {
        return $this->render('ads/admin/selectAdsPage.html.twig');
    }

    public function addAdtoForumPageAdmin(Request $request, AlertifyHelper $alertify)
    {
        $getUserStatus = $this->getUser()->getActived();
        if ($getUserStatus == false) {
            return $this->redirectToRoute('home');
        } else {


            $ads = new ForumAds();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(AdminAdsType::class, $ads);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();


                $file = $ads->getPhoto();
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('post_directory'), $filename);
                $ads->setPhoto($filename);
                $em->persist($ads);
                $em->flush();


                $alertify->congrat('Congratulation !');
                // if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                //  return new RedirectResponse('/');
            }

            return $this->render('ads/admin/ForumAdsAdd.html.twig', array(
                "Form" => $form->createView()
            ));
        }
    }
    public function addAdtoProductPageAdmin(Request $request, AlertifyHelper $alertify)
    {
        $getUserStatus = $this->getUser()->getActived();
        if ($getUserStatus == false) {
            return $this->redirectToRoute('home');
        } else {


            $ads = new ProductAds();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(AdminAdsProduct::class, $ads);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();


                $file = $ads->getPhoto();
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('post_directory'), $filename);
                $ads->setPhoto($filename);
                $em->persist($ads);
                $em->flush();


                $alertify->congrat('Congratulation !');
                // if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                //  return new RedirectResponse('/');
            }

            return $this->render('ads/admin/ProductAdsAdd.html.twig', array(
                "Form" => $form->createView()
            ));
        }
    }

    public function displayTarifsAds(){
        $em = $this->getDoctrine()->getManager();
        $tarifs = $em->getRepository(TarifAds::class)->findAll();
        return $tarifs;

    }

    public function PayWithStripeAction(Request  $request){

        $totalpacks = $this->session->get('totalpacks');


        \Stripe\Stripe::setApiKey("sk_test_51IfLeDJJkXu5mowcDQfluMkL4tXDjYnH7o2chkKqgNnBHYyVzRgytKyqg2gu4A3Z92hl6I2C0yjITmIBQy0pcFBn00qqVPn7q8");
        \Stripe\Charge::create(array(
            "amount" =>$totalpacks*100,
            "currency"=>"chf",
            "source"=>$request->get('stripeToken'),
            "description"=>"Paiement Publicité"
        ));




        return $this->render('shop/thanks.html.twig');
    }
    public function displaymyPacks()
    {
        $totalpacks=null;
        $tar=null;
        $tarifsAds= $this->displayTarifsAds();
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        $myTarifAds = $em->getRepository(TarifAdsUser::class)
            ->createQueryBuilder('p')
            ->select("p, c,u")
            ->leftJoin('p.tarif', 'c')
            ->leftJoin('p.adv', 'u')
            ->where('p.user = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();

foreach ($myTarifAds as $tar){
   // print_r($tar['tarif']['price']);
    $totalpacks+=$tar['tarif']['price'];

    }
        $this->session->set('totalpacks', $totalpacks);
        return $this->render('ads/company/mypacks.html.twig'
            , array(
                "tarifsAds"=>$tarifsAds,
                "myTarifAds"=>$myTarifAds,
                "tar"=>$tar,
                "totalpacks"=>$totalpacks
            ));
    }




    public function AddAdssteptwo(Request $request, AlertifyHelper $alertify)
    {
        $adstarifuser = $this->session->get('adstarifuser');
        $getUserStatus = $this->getUser()->getActived();
        $user = $this->getUser();
        if ($getUserStatus == false) {
            return $this->redirectToRoute('home');
        } else {


            $ads = new TarifAdsUser();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(TarifAdsUserType::class, $ads);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();


                $ads->setPaid(false);
                $ads->setUser($user);
                $ads->setPrice($adstarifuser);
                $em->persist($ads);
                $em->flush();


                $alertify->congrat('Congratulation !');
                // if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                //  return new RedirectResponse('/');
            }

          // $form["tarif"]->getData();
            $tarif = $form->get('tarif')->getData();
            $var = $form->get('tarif')->getData();

            return $this->render('ads/company/addAdsteptwo.html.twig', array(
                "Form" => $form->createView(),
                "tarif"=>$tarif,
                "adstarifuser"=>$adstarifuser,
                "var"=>$var
            ));
        }
    }
    public function UpdatePackAdsAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $an = $em->getRepository(TarifAdsUser::class)->find($id);
        $form = $this->createForm(TarifAdsUserType::class, $an);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($an);
            $em->flush();
            return $this->redirectToRoute('myPacks');
        }
        return $this->render('ads/company/updatePack.html.twig',
            array('form'=>$form->createView()));
    }

    public function GetAllPacks(){
        $em = $this->getDoctrine()->getManager();
        $packs = $em->getRepository(TarifAds::class)->findAll();
        return $packs;

    }

    public function deletePackAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $ad = $em
            ->getRepository(TarifAdsUser::class)
            ->find($id);
        $em->remove($ad);
        $em->flush();
        return $this->redirectToRoute('myPacks');
    }

    public function UpdateAdsAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $an = $em->getRepository(Ads::class)->find($id);
        $form = $this->createForm(AdsType::class, $an);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($an);
            $em->flush();
            return $this->redirectToRoute('displayAdsCompany');
        }
        return $this->render('ads/company/updateAdd.html.twig',
            array('Form'=>$form->createView()));
    }

    public function UpdatePaymentStatus(Request $request, AlertifyHelper $alertify){
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Ads::class)
            ->find($id);
        if($event->isPayed()==true){
            $event->setPayed(false);
        }elseif ($event->isPayed()==false)
        {
            $event->setPayed(true);
        }
        $em->persist($event);
        $em->flush();
        $alertify->congrat('Status Updated !');
        return $this->redirectToRoute('displayAdsAdmin');
    }
}
