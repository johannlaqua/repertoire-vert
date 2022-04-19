<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Subcategory;
use App\Form\ProductType;
use App\Form\ServiceType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;


class ServiceController extends Controller\AbstractController
{

    /**
     * @Route("/services/ajout", name="serviceAdd")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function add(Request $request, FileUploader $fileUploader)
    {
        $em = $this->getDoctrine()->getManager();


        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');        
        $service = new Service();

        $user=$this->getUser();


        $form = $this->createForm(ServiceType::class, $service,  array(
            'user' => $user
        ));
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $service->setUpdateddate(new \DateTime());
            $service->setCreationdate(new \DateTime());
            $slugify = new Slugify();
            $slug=$slugify->slugify($service->getName());
            $service->setGaearecommanded(false);
            $service->setSlug($slug);
            $service->setCompany($user);
            $service->setType('service');
            if($service->isWantevaluation()){
                $service->setNiveau('N.1');
            } else{
                $service->setNiveau('N.0');
            }

            $file = $service->getImage();

            if ($file) {
                /*$fileName = uniqid() . '.' . $file->guessExtension();
                $file->move($this->getParameter('products'), $fileName);*/
                $fileName = $fileUploader->upload($file, $this->getParameter('products'));
                $service->setImage($fileName);

            }

            $name = $service->getName();

            
            $subcategories = $service->getSubCategories();

            foreach ($subcategories as $subcategory)
            {
                $subcategory->addProduct($service);
            }

            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('productManage');
        }
        return $this->render('services/add.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/services/{slug}", name="serviceShow")
     * @param $slug
     * @return Response
     */
    public function show($slug): Response
    {
        $n=0;
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->findOneBy(['slug' => $slug]);
        $service = $em->getRepository(Service::class)->findOneBy(['slug' => $slug]);
        if (!$service) {
            throw $this->createNotFoundException('service non trouvée');
        }
        return $this->render('services/FicheService.html.twig', [
            'service' => $service,
            'n'=>$n,
            'product'=>$product,

        ]);
    }

    /**
     * @Route("/services", name="servicesManage")
     */
    public function manage(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $services = $this->getDoctrine()->getRepository('App:Service')->createQueryBuilder('p')->andWhere('p.company = :id')
            ->setParameter('id', $this->getUser()->getId())
            ->getQuery()
            ->getResult();
        //dd($services);
        return $this->render('services/manage.html.twig', [
            'services' => $services
        ]);
    }

    /**
     * @Route("/services/modifier/{id}", name="servicesEdit")
     * @param $id
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit($id,Request $request, FileUploader $fileUploader)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        //Récupère la catégorie avec l'id $id
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository(Service::class)->findOneBy(['id' => $id]);

        //Si la catégorie n'existe pas on throw une 404
        if (!$service) {
            throw $this->createNotFoundException('service non trouvé');
        }

        $user=$this->getUser();
        $fileName = null;
        $oldImage=$service->getImage();
        if($service->getImage() != null){
            // Le formulaire a besoin du fichier image et non pas du nom de l'image
            $service->setImage(
                new File($this->getParameter('products').'/'.$service->getImage())
            );
            $fileName = $service->getImage();
        }

        $form = $this->createForm(ServiceType::class, $service,  array(
            'user' => $user
        ));

        $subcategories = $service->getSubCategories();
        foreach ($subcategories as $subcategory) {
            //$service->removeSubcategory($subcategory);
            $subcategory->removeProduct($service);
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service->setUpdateddate(new \DateTime());
            $slugify = new Slugify();
            $slug=$slugify->slugify($service->getName());
            $service->setSlug($slug);
            if($service->isWantevaluation()){
                $service->setNiveau('N.1');
            } else{
                $service->setNiveau('N.0');
            }

            if ($form->get('image')->getData() !== null) {
                $file = $service->getImage();

                //if ($file) {
                /*$fileName = uniqid() . '.' . $file->guessExtension();
                $file->move($this->getParameter('products'), $fileName);*/
                $fileName = $fileUploader->upload($file, $this->getParameter('products'));
                $service->setImage($fileName);

                //}
            } else {
                // On doit reset manuellement l'image à l'ancienne valeur si pas de modif car le formulaire le met à null automatiquement
                $service->setImage($oldImage);
            }

            foreach ($subcategories as $subcategory) {

                //$service->addSubcategory($subcategory);
                //$service->removeSubcategory($subcategory);
                //$subcategory->removeProduct($service);
                $subcategory->addProduct($service);
            }


            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('productManage');
        }
        return $this->render('services/edit.html.twig', [
            'form' => $form->createView(),
            'file_name' => $fileName,
            'user' => $user,
            'product' => $service,
        ]);
    }

    /**
     * @Route("/services/supprimer/{id}", name="servicesDelete")
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository('App:Service')->findOneBy(array('id' => $id));
        if ($this->getUser()->getRole() == "ROLE_COMPANY" and $this->getUser() == $service->getCompany()) {
            //DELETE
            $em->remove($service);
            $em->flush();
            $path = $service->getImage();
            /*if($path){
                unlink($path);
            }*/
        }
        return $this->redirectToRoute('productManage');
    }
}
