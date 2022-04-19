<?php

/* -- !!!!! LA CLASSE "Marchandise" CORRESPOND AUX PRODUIT ET LA   !!!!! -- */
/* -- !!!!! CLASSE "Product" EST LA SUPERCLASSE DES PRODUITS ET    !!!!! -- */
/* -- !!!!! DES SERVICES. CE CONTROLEUR NE CORRESPOND QUE A LA     !!!!! -- */
/* -- !!!!! GESTION DES PRODUITS (classe "Marchandise") ET NON     !!!!! -- */
/* -- !!!!! A LA GESTION DES SERVICES (sauf pour productShow et    !!!!! -- */
/* -- !!!!! productSearch qui s'occupent des produits et des       !!!!! -- */
/* -- !!!!! services)                                              !!!!! -- */

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Product;
use App\Entity\ProductClick;
use App\Entity\Marchandise;
use App\Entity\ProductFav;
use App\Entity\Service;
use App\Entity\Subcategory;
use App\Entity\User;
use App\Entity\Visite;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Service\FileUploader;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Json;


class ProductController extends Controller\AbstractController
{
    /**
     * @Route("/produit/ajout", name="productAdd")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function add(Request $request, FileUploader $fileUploader)
    {
        $em = $this->getDoctrine()->getManager();

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $marchandise = new Marchandise();

        $user=$this->getUser();

        $form = $this->createForm(ProductType::class, $marchandise, array(
            'user' => $user
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marchandise->setUpdateddate(null);
            $marchandise->setCreationdate(new \DateTime());
            $slugify = new Slugify();
            $slug=$slugify->slugify($marchandise->getName());
            $marchandise->setGaearecommanded(false);
            $marchandise->setSlug($slug);
            $marchandise->setCompany($user);
            $marchandise->setType('marchandise');
            $file = $marchandise->getImage();
            if($marchandise->isWantevaluation()){
                $marchandise->setNiveau('N.1');
            } else{
                $marchandise->setNiveau('N.0');
            }
            //$product->setImage($imageName);

            if ($file) {
                /*$fileName = uniqid() . '.' . $file->guessExtension();
                $file->move($this->getParameter('products'), $fileName);*/
                $fileName = $fileUploader->upload($file, $this->getParameter('products'));
                $marchandise->setImage($fileName);

            }
            
           $subcategories = $marchandise->getSubCategories();

            foreach ($subcategories as $subcategory)
            {
                $subcategory->addProduct($marchandise);
            }

            $em->persist($marchandise);
            $em->flush();
            
            return $this->redirectToRoute('productManage');
        }
        return $this->render('product/add.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/produit/modifier/{id}", name="productEdit")
     * @param $id
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit($id,Request $request, FileUploader $fileUploader)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        //Récupère la marchandise avec l'id $id
        $em = $this->getDoctrine()->getManager();
        $marchandise = $em->getRepository(Marchandise::class)->findOneBy(['id' => $id]);

        //Si la catégorie n'existe pas on throw une 404
        if (!$marchandise) {
            throw $this->createNotFoundException('produit non trouvé');
        }
        $user=$this->getUser();
        $fileName = null;
        $oldImage = $marchandise->getImage();
        if($marchandise->getImage() != null){
            // Le formulaire a besoin du fichier image et non pas du nom de l'image
            $marchandise->setImage(
                new File($this->getParameter('products').'/'.$marchandise->getImage())
            );
            $fileName = $marchandise->getImage()->getFileName();
            //dd($fileName);
        }

        $form = $this->createForm(ProductType::class, $marchandise, array(
            'user' => $user
        ));
        $subcategories = $marchandise->getSubCategories();
        foreach ($subcategories as $subcategory) {

            //$marchandise->removeSubcategory($subcategory);
            $subcategory->removeProduct($marchandise);
        }
        //dd($subcategories);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $marchandise->setUpdateddate(new \DateTime());
            $slugify = new Slugify();
            $slug=$slugify->slugify($marchandise->getName());
            $marchandise->setSlug($slug);
            if($marchandise->isWantevaluation()){
                $marchandise->setNiveau('N.1');
            } else{
                $marchandise->setNiveau('N.0');
            }
            //$image=$marchandise->getImage();
            //$marchandise->setImage($image);

            if ($form->get('image')->getData() !== null) {
                $file = $marchandise->getImage();

                //if ($file) {
                /*$fileName = uniqid() . '.' . $file->guessExtension();
                $file->move($this->getParameter('products'), $fileName);*/
                $fileName = $fileUploader->upload($file, $this->getParameter('products'));
                $marchandise->setImage($fileName);

                //}
            } else {
                // On doit reset manuellement l'image à l'ancienne valeur si pas de modif car le formulaire le met à null automatiquement
                $marchandise->setImage($oldImage);
            }


            $subcategories = $marchandise->getSubCategories();
            //dd($subcategories);
            //$marchandise->setSubCategories($subcategories);

            foreach ($subcategories as $subcategory) {

                $subcategory->addProduct($marchandise);
            }

            $em->persist($marchandise);
            $em->flush();
            return $this->redirectToRoute('productManage');
        }
        /*if($form->isSubmitted() && !$form->isValid()) {
            $marchandise->setImage(null);
            $em->persist($marchandise);
            $em->flush();

        }*/
        //dump($form);
        return $this->render('product/edit.html.twig', [
            'form' => $form->createView(),
            'file_name' => $fileName,
            'user' => $user,
            'product' => $marchandise
        ]);
    }

    public function deleteOldImages(){
        // $images=glob("web/css/img/product/*.{jpg,jpeg,png,gif}");
        $em = $this->getDoctrine()->getManager();
        $marchandises = $em->getRepository('App:Marchandise')->findAll();
        //dump(glob("web/css/img/product/*.png"));

        foreach (glob("web/css/img/product/*.png") as $filename) {
            echo "$filename occupe " . filesize($filename) . "\n";
            //dump($filename);
        }

        /*
        foreach(glob("web/css/img/product/*.png") as $imageValue){
            //dump('boucle 1');
            foreach($marchandises as $productValue){
                //dump('boucle 2');
                $path=$productValue->getImage();
                if($images[$imageValue]==$path){
                    //dump('condition if');
                    break 2;
                }else{
                    unlink($imageValue);
                }
            }
        }
        */
    }

    /**
     * @Route("/produit/{id}", name="productShow")
     * @param $id
     * @return Response
     */
    public function show($id): Response
    {
        $n=0;
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository(Product::class)->findOneBy( array('id' => $id ) );
            $user=$this->getUser();
            $productFav = $em->getRepository(ProductFav::class)->findOneBy( array('user' => $user,'product' => $product ) );

            if($productFav == null)
        {
            $n=0;

        } else {
            $n=1;

        }

        } else {
            $n=3;

        }

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->findOneBy(['id' => $id]);
        /*$date=(new \DateTime());

        $clicks = $em->getRepository(ProductClick::class)->findOneBy( array('product' => $product, 'date' => $date) );


        if ($clicks==null):
            $click = new ProductClick();

            $click->setDate($date);
            $click->setProduct($product);
            $click->setCompany($product->getCompany());
            $click->setNumber(1);
            $em->persist($click);
            $em->flush();
        else :

            $clicks->setNumber($clicks->getNumber()+1);
            $em->persist($clicks);
            $em->flush();

        endif;*/


        // RECUPERATION DES COMMENTAIRES/AVIS
        $avis = new ArrayCollection();
        //  on separe en 2 pour users et company

        $tableaux_avis_user =[

        ];
        $tableaux_avis_company =[

        ];



            $count1 = 0;
            $count2 = 0;

            $note1 = 0;
            $note2 = 0;

            foreach ($product->getProductComments() as &$comment) {

                $avis->add($comment);
                $id_product = $product->getId();
                if ($comment->getCreator() instanceof Company)
                {
                    // dump('company bro for the article',$id_product);
                    $count1 ++;
                    $note1 += random_int(0,5);
                    $moyenne1 = intval(ceil($note1 / $count1));
                    $tableaux_avis_company['avis_'.$id_product]  = $count1;
                    $tableaux_avis_company['note_'.$id_product]  = $moyenne1;
                }
                else{
                    //dump('user bro for the article',$id_product);
                    $count2 ++;
                    $note2 += random_int(0,5);
                    $moyenne2 = intval(ceil($note2 / $count2));

                    $tableaux_avis_user['avis_'.$id_product]  = $count2;
                    $tableaux_avis_user['note_'.$id_product]  = $moyenne2;
                }

            }


        if (!$product) {  
            throw $this->createNotFoundException('produit/service non trouvé');
        }

        foreach ($product->getProductFavProducts() as $fav) {
            $product->addProductFavProduct($fav);
        }
    //dd($product);

        if ($product instanceof Marchandise) {
            $marchandise = $em->getRepository(Marchandise::class)->findOneBy(['id' => $id]);
           // dd('hello marchandises');
            return $this->render('product/ficheProduit.html.twig', [
                'marchandise' => $marchandise,
                'product'=>$product,
                'avis_users'=>$tableaux_avis_user,
                'avis_companies'=>$tableaux_avis_company,
                'n'=>$n
            ]);
        }
        elseif ($product instanceof Service) {
            $service = $em->getRepository(Service::class)->findOneBy(['id' => $id]);


            // RECUPERATION DES COMMENTAIRES/AVIS
            $avis = new ArrayCollection();
            //  on separe en 2 pour users et company

            $tableaux_avis_user =[

            ];
            $tableaux_avis_company =[

            ];



            $count1 = 0;
            $count2 = 0;

            $note1 = 0;
            $note2 = 0;

            foreach ($service->getProductComments() as &$comment) {

                $avis->add($comment);
                $id_product = $service->getId();
                if ($comment->getCreator() instanceof Company)
                {
                    // dump('company bro for the article',$id_product);
                    $count1 ++;
                    $note1 += random_int(0,5);
                    $moyenne1 = intval(ceil($note1 / $count1));
                    $tableaux_avis_company['avis_'.$id_product]  = $count1;
                    $tableaux_avis_company['note_'.$id_product]  = $moyenne1;
                }
                else{
                    //dump('user bro for the article',$id_product);
                    $count2 ++;
                    $note2 += random_int(0,5);
                    $moyenne2 = intval(ceil($note2 / $count2));

                    $tableaux_avis_user['avis_'.$id_product]  = $count2;
                    $tableaux_avis_user['note_'.$id_product]  = $moyenne2;
                }

            }
            //dd('hello services');
            return $this->render('services/FicheService.html.twig', [
                'service' => $service,
                'product'=>$product,
                'avis_users'=>$tableaux_avis_user,
                'avis_companies'=>$tableaux_avis_company,
                'n'=>$n
            ]);
        }

    }

    /**
     * @Route("/produits", name="productManage")
     */
    public function manage(CategoryRepository $categoryRepository): Response
    {

        $company = $this->getUser();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $marchandises = $this->getDoctrine()
            ->getRepository('App:Marchandise')
            ->createQueryBuilder('p')
            ->andWhere('p.company = :id')
            ->setParameter('id', $this->getUser()->getId())
            ->getQuery()
            ->getResult();
            // si on veut recuperer et les marchandises et les services
        $products = $this->getDoctrine()
            ->getRepository('App:Product')
            ->createQueryBuilder('p')
            ->andWhere('p.company = :id')
            ->setParameter('id', $this->getUser()->getId())
            ->getQuery()
            ->getResult();

        // RECUPERATION DES COMMENTAIRES/AVIS
        $avis = new ArrayCollection();
        //  on separe en 2 pour users et company
        $tableaux_avis_company =[

        ];
        $tableaux_avis_user =[

        ];


        foreach ($products as $product)
        {
            $count1 = 0;
            $count2 = 0;

            $note1 = 0;
            $note2 = 0;

            foreach ($product->getProductComments() as &$comment) {

                $avis->add($comment);
                $id_product = $product->getId();
                if ($comment->getCreator() instanceof Company)
                {
                   // dump('company bro for the article',$id_product);
                    $count1 ++;
                    $note1 += random_int(0,5);
                    $moyenne1 = intval(ceil($note1 / $count1));
                    $tableaux_avis_company['avis_'.$id_product]  = $count1;
                    $tableaux_avis_company['note_'.$id_product]  = $moyenne1;
                }
                else{
                    //dump('user bro for the article',$id_product);
                    $count2 ++;
                    $note2 += random_int(0,5);
                    $moyenne2 = intval(ceil($note2 / $count2));

                    $tableaux_avis_user['avis_'.$id_product]  = $count2;
                    $tableaux_avis_user['note_'.$id_product]  = $moyenne2;
                }

            }


        }

        $categories = $categoryRepository->findAll();
        $em = $this->getDoctrine()->getManager();
        $subcategories = $em->getRepository(Subcategory::class)->findByCompany($company->getId());

        $this->deleteOldImages();
        return $this->render('product/manage.html.twig', [
            'marchandises' => $marchandises,
            'products' => $products,
            'avis_users'=>$tableaux_avis_user,
            'avis_companies'=>$tableaux_avis_company,
            'company' => $company,
            //'categories' => $categories,
            'subcategories' => $subcategories
        ]);
    }

    /**
     * @Route("/produit/recherche/{param}", name="productSearch")
     * @param $param
     * @return Response
     */
    public function search($param): Response
    {
        $company = $this->getUser();
        $idcompany = $company->getId();
        //dd($idcompany);
        $slugify = new Slugify();
        $slug_param=$slugify->slugify($param);
        //dd($slug_param);
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->where('p.owner = :idcompany')
            ->setParameter('idcompany', $idcompany)
            ->andWhere('p.slug LIKE :slug')
            ->setParameter('slug', "%" . $slug_param . "%")
            ->getQuery()
            ->getResult();
        //dd($products[0]->getName());
        // RECUPERATION DES COMMENTAIRES/AVIS
        $avis = new ArrayCollection();
        //  on separe en 2 pour users et company
        $tableaux_avis_company = [

        ];
        $tableaux_avis_user = [

        ];


        foreach ($products as $product) {
            $count1 = 0;
            $count2 = 0;

            $note1 = 0;
            $note2 = 0;

            foreach ($product->getProductComments() as &$comment) {

                $avis->add($comment);
                $id_product = $product->getId();
                if ($comment->getCreator() instanceof Company) {
                    // dump('company bro for the article',$id_product);
                    $count1++;
                    $note1 += random_int(0, 5);
                    $moyenne1 = intval(ceil($note1 / $count1));
                    $tableaux_avis_company['avis_' . $id_product] = $count1;
                    $tableaux_avis_company['note_' . $id_product] = $moyenne1;
                } else {
                    //dump('user bro for the article',$id_product);
                    $count2++;
                    $note2 += random_int(0, 5);
                    $moyenne2 = intval(ceil($note2 / $count2));

                    $tableaux_avis_user['avis_' . $id_product] = $count2;
                    $tableaux_avis_user['note_' . $id_product] = $moyenne2;
                }

            }
        }
        foreach ($products as $res)
        {
            $produits[] = $res->getId();
        }
        //dd($produits);
        return new JsonResponse([
            'produits'=>$produits,
        ]);
       /* return new JsonResponse([

            'utilisateurs'=>json_encode($tableaux_avis_user),
            'entreprises'=>json_encode($tableaux_avis_user),
        ]); */
    }


    /**
     * @Route("/produit/supprimer/{id}", name="productDelete")
     * @param $id
     * @return Response
     */
    public function delete($id): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $marchandise = $em->getRepository('App:Marchandise')->findOneBy(array('id' => $id));
        $em->remove($marchandise);
        $em->flush();
        $path = $marchandise->getImage();

        /*
        if ($this->getCompany() == $product->getCompany()) {
            //DELETE
            $em->remove($marchandise);
            $em->flush();
        }
        */
        /*
        if ($this->getUser()->getRole() == "ROLE_COMPANY" and $this->getUser() == $product->getCompany()) {
            //DELETE
            $em->remove($marchandise);
            $em->flush();
        }
        */
        return $this->redirectToRoute('productManage');
        //return $this->render('product/manage.html.twig', $path);
    }
    /**
     * @Route("/productsFav", name="productsFav")
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
        return $this->render('product/productsFav.html.twig', [
            'products' => $products,
            'productsFav'=>$productsFav
        ]);
    }


         // function show Productdetails
                     
     // @Route("product/show/{id}", name="ShowProductDetails" , requirements={"id"="\d+"})
     
     

    // public function showDetails($id){
     


    //     $em = $this->getDoctrine()->getManager();
    //     $product = $em->getRepository(Product::class)->findOneBy(['id' => $id]);
    //     // $marchandise =$em->getRepository(Marchandise::class)->findAll();
    //     // $product =$em->getRepository(Product::class)->findAll();
        
    //     return $this->render('product/showProductDetails.html.twig', [

    //         'product' => $product
    //         // 'marchandise' => $marchandise

    //     ]); 
    // }
  
    /**
     * @Route("/produits/{categoryId}/{subcategoryId}/{companyId}", name="ShowProductDetails" , requirements={"id"="\d+"})
     * 
     */
    public function productdetails(CategoryRepository $categoryRepository, $categoryId, $subcategoryId,$companyId): Response
    {   
        
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findOneBy(['id' => $companyId]);
        $subcategory =$em->getRepository(Subcategory::class)->findOneBy(['id' => $subcategoryId]);
        $subcategoryName= $subcategory->getName();

        $subcategories = $em->getRepository(Subcategory::class)->findByCompany($company->getId());

      
        $marchandises = $this->getDoctrine()
            ->getRepository('App:Marchandise')
            ->createQueryBuilder('p')
            ->andWhere('p.company = :id')
            ->setParameter('id', $company->getId())
            ->getQuery()
            ->getResult();
            // si on veut recuperer et les marchandises et les services
        $products = $this->getDoctrine()
            ->getRepository('App:Product')
            ->createQueryBuilder('p')
            ->andWhere('p.company = :id')
            ->setParameter('id', $company->getId())
            ->getQuery()
            ->getResult();

        // RECUPERATION DES COMMENTAIRES/AVIS
        $avis = new ArrayCollection();
        //  on separe en 2 pour users et company
        $tableaux_avis_company =[

        ];
        $tableaux_avis_user =[

        ];


        foreach ($products as $product)
        {
            $count1 = 0;
            $count2 = 0;

            $note1 = 0;
            $note2 = 0;

            foreach ($product->getProductComments() as &$comment) {

                $avis->add($comment);
                $id_product = $product->getId();
                if ($comment->getCreator() instanceof Company)
                {
                   // dump('company bro for the article',$id_product);
                    $count1 ++;
                    $note1 += random_int(0,5);
                    $moyenne1 = intval(ceil($note1 / $count1));
                    $tableaux_avis_company['avis_'.$id_product]  = $count1;
                    $tableaux_avis_company['note_'.$id_product]  = $moyenne1;
                }
                else{
                    //dump('user bro for the article',$id_product);
                    $count2 ++;
                    $note2 += random_int(0,5);
                    $moyenne2 = intval(ceil($note2 / $count2));

                    $tableaux_avis_user['avis_'.$id_product]  = $count2;
                    $tableaux_avis_user['note_'.$id_product]  = $moyenne2;
                }

          

            }


        }

        $categories = $categoryRepository->findAll();


       
        $this->deleteOldImages();
        return $this->render('product/showProductDetails.html.twig', [
            'marchandises' => $marchandises,
            'products' => $products,
            'avis_users'=>$tableaux_avis_user,
            'avis_companies'=>$tableaux_avis_company,
            'company' => $company,
            'categories' => $categories,
            'categoryId' => $categoryId, 
            'subcategoryId' => $subcategoryId,
            'subcategoryName'=>$subcategoryName,
            'subcategories' => $subcategories
        ]);

   


}


 /**
     * @Route("/ficheProduitNonConnecte/{categoryId}/{subcategoryId}/{companyId}/{productId}", name="ficheProduitNonConnecte" , requirements={"id"="\d+"})
     * 
     */
    public function productdetailsNonConnecte(CategoryRepository $categoryRepository, $companyId, $productId,$categoryId,$subcategoryId): Response
    {
          
        
        
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository(Product::class)->findOneBy( array('id' => $productId ) );
            $user= $em->getRepository(Company::class)->findOneBy(['id' => $companyId]);
            $productFav = $em->getRepository(ProductFav::class)->findOneBy( array('user' => $user,'product' => $product ) );

          

        

        // $em = $this->getDoctrine()->getManager();
        // $product = $em->getRepository(Product::class)->findOneBy(['id' => $id]);
        $date=(new \DateTime());

        $clicks = $em->getRepository(ProductClick::class)->findOneBy( array('product' => $product, 'date' => $date) );


        if ($clicks==null):
            $click = new ProductClick();

            $click->setDate($date);
            $click->setProduct($product);
            $click->setCompany($product->getCompany());
            $click->setNumber(1);
            $em->persist($click);
            $em->flush();
        else :

            $clicks->setNumber($clicks->getNumber()+1);
            $em->persist($clicks);
            $em->flush();

        endif;


        // RECUPERATION DES COMMENTAIRES/AVIS
        $avis = new ArrayCollection();
        //  on separe en 2 pour users et company

        $tableaux_avis_user =[

        ];
        $tableaux_avis_company =[

        ];



            $count1 = 0;
            $count2 = 0;

            $note1 = 0;
            $note2 = 0;

            foreach ($product->getProductComments() as &$comment) {

                $avis->add($comment);
                $id_product = $product->getId();
                if ($comment->getCreator() instanceof Company)
                {
                    // dump('company bro for the article',$id_product);
                    $count1 ++;
                    $note1 += random_int(0,5);
                    $moyenne1 = intval(ceil($note1 / $count1));
                    $tableaux_avis_company['avis_'.$id_product]  = $count1;
                    $tableaux_avis_company['note_'.$id_product]  = $moyenne1;
                }
                else{
                    //dump('user bro for the article',$id_product);
                    $count2 ++;
                    $note2 += random_int(0,5);
                    $moyenne2 = intval(ceil($note2 / $count2));

                    $tableaux_avis_user['avis_'.$id_product]  = $count2;
                    $tableaux_avis_user['note_'.$id_product]  = $moyenne2;
                }

            }


        if (!$product) {  
            throw $this->createNotFoundException('produit/service non trouvé');
        }

        foreach ($product->getProductFavProducts() as $fav) {
            $product->addProductFavProduct($fav);
        }
    //dd($product);

        if ($product instanceof Marchandise) {
            $marchandise = $em->getRepository(Marchandise::class)->findOneBy(['id' => $productId]);
        // dd('hello marchandises');
            return $this->render('product/ficheProduitNonConnecte.html.twig', [
                'marchandise' => $marchandise,
                'product'=>$product,
                'company'=>$user,
                'avis_users'=>$tableaux_avis_user,
                'avis_companies'=>$tableaux_avis_company,
                'subcategoryId'=>$subcategoryId,
                'categoryId'=>$categoryId
                // 'n'=>$n
            ]);
        }
        elseif ($product instanceof Service) {
            $service = $em->getRepository(Service::class)->findOneBy(['id' => $productId]);


            // RECUPERATION DES COMMENTAIRES/AVIS
            $avis = new ArrayCollection();
            //  on separe en 2 pour users et company

            $tableaux_avis_user =[

            ];
            $tableaux_avis_company =[

            ];



            $count1 = 0;
            $count2 = 0;

            $note1 = 0;
            $note2 = 0;

            foreach ($service->getProductComments() as &$comment) {

                $avis->add($comment);
                $id_product = $service->getId();
                if ($comment->getCreator() instanceof Company)
                {
                    // dump('company bro for the article',$id_product);
                    $count1 ++;
                    $note1 += random_int(0,5);
                    $moyenne1 = intval(ceil($note1 / $count1));
                    $tableaux_avis_company['avis_'.$id_product]  = $count1;
                    $tableaux_avis_company['note_'.$id_product]  = $moyenne1;
                }
                else{
                    //dump('user bro for the article',$id_product);
                    $count2 ++;
                    $note2 += random_int(0,5);
                    $moyenne2 = intval(ceil($note2 / $count2));

                    $tableaux_avis_user['avis_'.$id_product]  = $count2;
                    $tableaux_avis_user['note_'.$id_product]  = $moyenne2;
                }

            }
            //dd('hello services');
            return $this->render('services/FicheServiceNonConnecte.html.twig', [
                'service' => $service,
                'product'=>$product,
                'avis_users'=>$tableaux_avis_user,
                'avis_companies'=>$tableaux_avis_company,
                'subcategoryId'=>$subcategoryId,
                'categoryId'=>$categoryId,
                'companyId'=>$companyId
                // 'n'=>$n
            ]);
        }

    }
       
}
