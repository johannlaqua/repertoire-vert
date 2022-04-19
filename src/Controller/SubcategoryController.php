<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Company;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Subcategory;
use App\Entity\Product;
use App\Entity\Catjoinsubcat;
use App\Form\CatjoinsubcatType;
use App\Form\SubcategoryType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManager;

class SubcategoryController extends AbstractController
{
    /**
     * @Route("/subcategory", name="subcategory")
     */
    public function index(): Response
    {
        return $this->render('subcategory/index.html.twig', [
            'controller_name' => 'SubcategoryController',
        ]);
    }
    /**
     * @Route("/subcategory/add/", name="subcategoryAdd")
     */
    public function add(Request $request)
    {

        $subcategory = new Subcategory();
        $form = $this->createForm(SubcategoryType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $subcategory->getSlug();
            $slugify = new Slugify();
            $slug = $slugify->slugify($subcategory->getName());
            $fileName = $slug . '.' . $file->guessExtension();

            $subcategory->setSlug($slug);
            $file->move(
                $this->getParameter('subcategories_directory'),
                $fileName
            );
            dump($slug);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($subcategory);
            $em->flush();

            return $this->redirectToRoute('addsubcategory');
        }


        return $this->render('category/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/administration/subcategories/",name="subcategoryManage")
     */
    public function manage(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $subcategories = $em->getRepository('App:Subcategory')->findAll();
        return $this->render('subcategory/manage.html.twig', [
            'subcategories' => $subcategories,
        ]);

    }



    /**
     * @Route("/subcategory/edit/{id}", name="subcategoryEdit")
     */
    public function edit($id, Request $request)
    {
        $idparam = $id;
        $em = $this->getDoctrine()->getManager();
        $subcategory = $em->getRepository(Subcategory::class)->findOneBy(['id' => $id]);
        $slugify = new Slugify();

        if (!$subcategory) {
            throw $this->createNotFoundException('Categorie non trouvée');
        }


        $form = $this->createForm(SubcategoryType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugify->slugify($subcategory->getName());


            $file = $form->get('image')->getData();
            if ($file != null) {
                $slug = $slugify->slugify($subcategory->getName());
                $fileName = $slug . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('categories_directory'),
                    $fileName
                );
                $subcategory->setSlug($slug);

            } else {
                $subcategory->setSlug($slug);
            }
            $em->persist($subcategory);
            $em->flush();
            return $this->redirectToRoute('subcategoryEdit', ['id' => $idparam]);
        }
        return $this->render('subcategory/form.html.twig',[
            'form'=>$form->createView(),
            'categoryName'=>$subcategory->getName(),

        ]);

    }
    /**
     * @Route("/administration/subcategory/delete/{id}", name="subcategoryDelete")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $subcategory = $em->getRepository('App:Subcategory')->findOneBy(array('id' => $id));
        if ($subcategory) {
            //DELETE
            $em->remove($subcategory);
            $em->flush();
        }
        return $this->redirectToRoute('subcategoryManage');
    }



    /**
     * @Route("/category/{catId}/subcategory/show/{subcatId}", name="subcategoryShowProductsServices")
     * @Method("POST")
     */
    public function showCompanies($catId, $subcatId, PaginatorInterface $paginator, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $subcategory = $em->getRepository(Subcategory::class)->findOneBy(['id' => $subcatId]);
        $category = $em->getRepository(Category::class)->findOneBy(['id' => $catId]);

        $companiesQuery = $em->getRepository(Company::class)->getCompaniesByCatAndSubcat($catId, $subcatId);

        $allsubcategories = new ArrayCollection();

        foreach ($category->getSubcategories() as $subcat)
        {
            $allsubcategories[] = $subcat;
        }

        $companies = $paginator->paginate(
            $companiesQuery,
            $request->query->getInt('page', 1), 10);

        return $this->render('subcategory/show.html.twig', [
            'subcategory' => $subcategory,
            'category' => $category,
            'allsubcategories' => $allsubcategories,
            'companies' => $companies,
        ]);
    }

}
