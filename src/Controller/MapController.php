<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Friendship;
use App\Entity\User;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Person;
use App\Form\PersonType;
use Cocur\Slugify\Slugify;

class MapController extends AbstractController
{
    public function displayProductsMapPage()
    {

        return $this->render('Maps/Productmap.html.twig');

    }
    public function displayCompaniesMapPage(CategoryRepository $repository)
    {

        return $this->render('Maps/Companymap.html.twig', [
            'categories' => $repository->findAll()
        ]);

    }
}
