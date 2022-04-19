<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class CategoryController extends AbstractController
{
    /**
     * @Route("/welcome", name="welcome")
     */
    public function index(): Response
    {
        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
    /*****************************************************************/

//*********************************************************
    /**
     * @Route("/category/edit/{id}", name="categoryEdit")
     */
    public function edit($id, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //Récupère la catégoire avec l'if $id
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository(Category::class)->findOneBy(['id' => $id]);
        //Si la catégorie n'existe pas on throw une 404
        if (!$category) {
            throw $this->createNotFoundException('Categorie non trouvée');
        }

        $image = $category->getImage();

        $originalSub = new ArrayCollection();
        $originalImage = [];
        foreach ($category->getSubcategory() as $subcategory) {
            $originalSub->add($subcategory);
            $originalImage[$subcategory->getSlug()] = $subcategory->getImage();
        }
        $form = $this->createForm(CategoryType::class, $category);
        $slugify = new Slugify();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //TODO: valider les sous-catégories
            foreach ($category->getSubcategories() as $subcategory) {
                if (!$originalSub->contains($subcategory)) {
                    if ($subcategory->getImage() == null) {
                        $form->addError(new FormError('l\'image et obligatoire de : ' . $subcategory->getName()));
                    }
                    if (!empty($em->getRepository(Subcategory::class)->findOneBy(['name' => $subcategory->getname()]))) {
                        $form->addError(new FormError('la sous-catégorie' . $subcategory->getName() . 'exsiste déja'));
                        break;
                    }

                }
            }
            if ($form->isValid()) {
                //TODO: Sauver la catégories et les sous-catégories
                $slug = $slugify->slugify($category->getName());
                $category->setSlug($slug);
                if ($category->getImage() == null) {
                    $file = new File($image);
                    $category->setImage($file->getFilename());
                }
                //Modification des sous catégories
                foreach ($originalSub as $subcategory) {
                    if ($subcategory->getImage() == null) {
                        $file = new File($originalImage[$subcategory->getSlug()]);
                        $subcategory->setImage($file->getFilename());
                    }
                    if (false === $category->getSubcategory()->contains($subcategory)) {
                        $category->getSubcategory()->removeElement($subcategory);
                        $em->persist($subcategory);
                    }
                }
                array_unique($category->getSubcategory()->toArray(), SORT_REGULAR);
                $em->persist($category);
                $em->flush();
                $this->addFlash(
                    'notice',
                    'Catégorie enregistrée'
                );

                return $this->redirectToRoute('categoryEdit', ['id' => $id]);
            }
        }
        return $this->render('category/edit.html.twig', [
            'form' => $form->createView(),
            'categoryName' => $category->getName(),

        ]);

    }

    /**
     * @Route("/administration/categories/",name="categoryManage")
     */
    public function manage(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('App:Category')->findAll();

        return $this->render('category/manage.html.twig', [
            'categories' => $categories,
        ]);

    }

    /**
     * @Route("/category/add/", name="categoryAdd")
     */
    public function add(Request $request)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $slugify = new Slugify();
        $category = new Category();
        $originalSubcategories = new ArrayCollection();
        $em = $this->getDoctrine()->getManager();
        $imageName = "empty.png";

        foreach ($category->getsubcategory() as &$subcategory) {
            $originalSubcategories->add($subcategory);
        }

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($originalSubcategories as $subcategory) {

                $file = $subcategory->getImage();
                $slug = $slugify->slugify($subcategory->getName());
                $imageName = $subcategory->getImage();
                $subcategory->setSlug($slug);
                $category->setImage($imageName);

                if ($file) {
                    $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                    $file->move(
                        $this->getParameter('subcategories_directory'),
                        $fileName
                    );
                    $category->setImage($fileName);
                    if (false === $category->getSubcategory()->contains($category)) {
                        $em->persist($subcategory);
                    }
                }
                $em->persist($subcategory);
            }

            $file = $category->getImage();
            $slug = $slugify->slugify($category->getName());
            $category->setSlug($slug);
            $category->setImage($imageName);

            if ($file) {
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('categories_directory'),
                    $fileName
                );
                $category->setImage($fileName);
            }
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('categoryAdd');
        }
        return $this->render('category/add.html.twig', [
            'form' => $form->createView(),
            'categoryName' => $category->getName(),
        ]);
    }

    /**
     * @Route("/get-categories", methods="GET")
     */
    public function getAlLCategories(CategoryRepository $repository)
    {
        $categories = $this->getDoctrine()->getRepository('App:Category')->findAll();

        foreach ($categories as $category){
            $subcategories =  $category->getSubcategories();
            //dd($subcategories);
            $subcatItems = array();
            foreach ($subcategories as $subcat) {
                $subcatItems[] = array(
                    'name' => $subcat->getName(),
                    'id' => $subcat->getId()
                );
            }
            $data[] = array(
                'id' => $category->getId(),
                'name' => $category->getName(),
                'subcategories' => $subcatItems
            );
        }




        /////////////// handle Circular Reference when serializing ///////////////////
        /*$encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getName();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);

        $serializer = new Serializer([$normalizer], [$encoder]);*/

        ///////////////////////////////////////////////////////
        //$data = $serializer->serialize($data,'json');
        //$data = $this->get('serializer')->serialize($data, 'json');

        return new JsonResponse($data, Response::HTTP_OK, [], false);
    }

    /**
     * @Route("{catId}/get-subcategories/", methods="GET")
     */
    private function getSubCat($catId)
    {
        $em = $this->getDoctrine()->getManager();

        $data = $em->getRepository(Catjoinsubcat::class)->findBy(['idx_category' => $catId]);

        $data = $this->get('serializer')->serialize($data, 'json');
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    public function getCategory($id)
    {
        return $this->getDoctrine()->getRepository('App:Category')->find($id);
    }

    /**
     * @Route("/category/{slug}", name="blog_show")
     */
    public function show($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->findOneBy(['slug' => $slug]);
        if (!$category) {
            throw $this->createNotFoundException('La categorie n\'existe pas');
        }
        $all_categories = $em->getRepository(Category::class)->findAll();
        //dd($all_categories);
        $originalSubcategories = new ArrayCollection();
        foreach ($category->getSubcategories() as &$subcategory) {
            $originalSubcategories->add($subcategory);
        }
       // dd($category);
        $chemin= '';
        $category_name= '';
        $subcat_name= '';
        return $this->render('category/show.html.twig', [
            'chemin2'=>$chemin,
            'category_name'=>$category_name,
            'subcat_name'=>$subcat_name,
            'allcategories'=>$all_categories,
            'category' => $category,
            'subcategories' => $originalSubcategories,
            'subCategoriesCount' => count($originalSubcategories),
        ]);
    }


    /**
     * @Route("/administration/category/delete/{id}", name="categoryDelete")
     */
    public function delete($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('App:Category')->findOneBy(array('id' => $id));
        if ($category) {
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('categoryManage');

    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

}
