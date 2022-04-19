<?php

namespace App\Controller;

use App\Entity\CommentProductFav;
use App\Entity\Company;
use App\Entity\CompanyFav;
use App\Entity\CompanyFavoris;
use App\Entity\Depense;
use App\Entity\Product;
use App\Entity\ProductClick;
use App\Entity\ProductComment;
use App\Entity\Visite;
use App\Repository\CompanyFavorisRepository;
use App\Repository\CompanyFavRepository;
use App\Repository\ProductClickRepository;
use App\Repository\VisiteRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\Common\Collections\ArrayCollection ;

use Symfony\Component\Validator\Constraints\DateTime;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboardold", name="dashboardold")
     */
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    /**
     * @Route("/Dashboard/", name="Dashboard")
     */
    public function Dashboard(VisiteRepository $VisitsRepo,Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $CompanyId = $this->getUser()->getId();
        $company = $em->getRepository(Company::class)->findOneBy(['id' => $this->getUser()->getId()]);
        $visites = $em->getRepository(Visite::class)->findBy(['company' => $company->getId() ],['date' => 'ASC']);

        $format = 'Y-m-d';
        $today = date("Y-m-d");
        $date = \DateTime::createFromFormat($format,$today); // on recupere la date d'aujourd'hui 
        $vardate = \DateTime::createFromFormat($format,$today); // on en recupere une 1ere copie
        $n=0;
        $number=0;

        $visitesDate=[];
        $visitesNumber=[];
        $Names=[];
        $months = 0 ;
        //$months = $request->get('id');

        if($months==0){
            date_sub($vardate,date_interval_create_from_date_string('7 days'));
        }
        else if($months==1){
            //dd("ui");
            date_sub($vardate,date_interval_create_from_date_string(strval($months)." month"));
        }
        else {
            date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
        }

        if($months==0){ // si c'est une semaine on met juste les jours
            setlocale(LC_TIME, "fr_FR");
            // != avant
            while($vardate <= $date){ // on creer le tableau de la semaine vide
                $x = $vardate->format("l d");
                $visitesDate[]=$x;
                $visitesNumber[]=0;
                $Names[]="Rien";
                date_add($vardate,date_interval_create_from_date_string('1 days'));
            }
            date_sub($vardate,date_interval_create_from_date_string('7 days'));
            //dd($vardate);
            foreach ($visites as $visite){
                $dateVisite=$visite->getDate();
                if($vardate <= $dateVisite){
                    $column = $dateVisite->format("l d");
                    $i = array_search($column,$visitesDate);
                    //on ajoute la visite seulement si on a trouvé l'index de la date voulue
                    if($i){
                        $visitesNumber[$i]=$visite->getNumber();
                    }

                }      
                $n=array_sum(($visitesNumber));
            }
        }

        return $this->render('company/dashboardVisite.html.twig', [
            'months'=>$months,
            'visitesDate'=> json_encode($visitesDate),
            'visitesNumber' => json_encode($visitesNumber),
            'Names'=>$Names,
            'n' => json_encode($n),
            'CompanyId' => json_encode($CompanyId),
            'number' =>$number,
            'Company' => $company
        ]);
    }
    /**
     * @Route("/StatistiquesVisites2/{id}", name="StatistiquesVisites2")
     */
    public function StatistiquesVisites2(VisiteRepository $VisitsRepo,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $CompanyId = $this->getUser()->getId();
        $company = $em->getRepository(Company::class)->findOneBy(['id' => $this->getUser()->getId()]);
        $visites = $em->getRepository(Visite::class)->findBy(['company' => $company->getId() ],['date' => 'ASC']);

        $format = 'Y-m-d';
        $today = date("Y-m-d");
        $date = \DateTime::createFromFormat($format,$today); // on recupere la date d'aujourd'hui
        $vardate = \DateTime::createFromFormat($format,$today); // on en recupere une 1ere copie
        $n=0;
        $number=0;

        $visitesDate=[];
        $visitesNumber=[];
        $Names=[];
        $months = $request->get('id');

        if($months==0){
            date_sub($vardate,date_interval_create_from_date_string('7 days'));
        }
        else if($months==1){
            if($vardate->format('d') > 28){
                date_sub($vardate,date_interval_create_from_date_string("3 days"));
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." month"));
            } else{
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." month"));
            }

        }
        else {
            if($vardate->format('d') > 28){
                date_sub($vardate,date_interval_create_from_date_string("3 days"));
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
            } else{
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
            }
        }

        if($months==0){ // si c'est une semaine on met juste les jours
            setlocale(LC_TIME, "fr_FR");
            while($vardate <= $date){ // on creer le tableau de la semaine vide
                $x = $vardate->format("l d");
                $visitesDate[]=$x;
                $visitesNumber[]=0;
                $Names[]="Rien";
                date_add($vardate,date_interval_create_from_date_string('1 days'));
            }
            date_sub($vardate,date_interval_create_from_date_string('7 days'));
            foreach ($visites as $visite){
                $dateVisite=$visite->getDate();
                if($vardate <= $dateVisite){
                    $column = $dateVisite->format("l d");
                    $i = array_search($column,$visitesDate);
                    if($i){
                        $visitesNumber[$i]=$visite->getNumber();
                    }

                }
                $n=array_sum(($visitesNumber));
            }
        }
        else{ // sinon faut entasser par mois
            setlocale(LC_TIME, "fr_FR");
            while($vardate <= $date){ // on creer le tableau des mois vide
                $x = $vardate->format("F Y");
                dump($x);
                $visitesDate[]=$x;
                $visitesNumber[]=0;
                $Names[]="Rien";
                date_add($vardate,date_interval_create_from_date_string('1 month'));
            }

            date_sub($vardate,date_interval_create_from_date_string((strval($months)+1)." months"));
            date_sub($vardate,date_interval_create_from_date_string('1 day'));

            foreach($visites as $visite){
                $dateVisite=$visite->getDate();
                if($vardate<$dateVisite){ // si la visite se trouve dans la periode selectionnee
                    $column =$visite->getDate()->format('F Y');
                    $i = array_search($column,$visitesDate);
                    $visitesNumber[$i]+=$visite->getNumber();
                }
            }
            $n=array_sum(($visitesNumber));
        }
        return new JsonResponse([
            'months'=>$months,
            'Date'=> $visitesDate,
            'Number' => $visitesNumber,
            'Names'=>$Names,
            'n' => json_encode($n),
            'CompanyId' => json_encode($CompanyId),
            'number' =>json_encode($number),
            'Company' => json_encode($company)
        ]);

    }

    /**
     * @Route("/StatistiquesFavoris/{id}", name="StatistiquesFavoris")
     */
    public function StatistiquesFavoris(CompanyFavorisRepository  $CompanyFavoris,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findOneBy(['id' => $this->getUser()->getId()]);
        $CompanyId = $this->getUser()->getId();
        $favoris = $em->getRepository(CompanyFav::class)->findBy(['company' => $company->getId() ],['date' => 'ASC']);
        $favorisDate=[];
        $favorisNumber=[];  
        $Names=[];

        $format = 'Y-m-d';
        $today = date("Y-m-d");
        $date = \DateTime::createFromFormat($format,$today); // on recupere la date d'aujourd'hui 
        $vardate = \DateTime::createFromFormat($format,$today); // on en recupere une 1ere copie
        $n=0;
        $number=0;

        $months = $request->get('id');

        if($months==0){
            date_sub($vardate,date_interval_create_from_date_string('7 days'));
        }
        else if($months==1){
            if($vardate->format('d') > 28){
                date_sub($vardate,date_interval_create_from_date_string("3 days"));
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." month"));
            } else{
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." month"));
            }

        }
        else {
            if($vardate->format('d') > 28){
                date_sub($vardate,date_interval_create_from_date_string("3 days"));
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
            } else{
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
            }
        }

        if($months==0){ // si c'est une semaine on met juste les jours
            setlocale(LC_TIME, "fr_FR");
            while($vardate <= $date){ // on creer le tableau de la semaine vide
                $x = $vardate->format("l d");
                $favorisDate[]=$x;
                $favorisNumber[]=0;
                $Names[]="Rien";
                date_add($vardate,date_interval_create_from_date_string('1 days'));
            }
            date_sub($vardate,date_interval_create_from_date_string('7 days'));
            foreach ($favoris as $fav){
                $dateFavori=$fav->getDate();
                if($vardate <= $dateFavori){
                    $column = $dateFavori->format("l d");
                    $i = array_search($column,$favorisDate);
                    $favorisNumber[$i]+=1;
                }      
                $n=array_sum(($favorisNumber));
            }
        }
        else{ // sinon faut entasser par mois
            setlocale(LC_TIME, "fr_FR");
            while($vardate <= $date){ // on creer le tableau des mois vide
                $x = $vardate->format("F Y");
                $favorisDate[]=$x;
                $favorisNumber[]=0;
                $Names[]="Rien";
                date_add($vardate,date_interval_create_from_date_string('1 month'));
            }
            date_sub($vardate,date_interval_create_from_date_string((strval($months)+1)." months"));
            date_sub($vardate,date_interval_create_from_date_string('1 day'));
            foreach($favoris as $fav){
                $dateFavori=$fav->getDate();
                if($vardate<$dateFavori){ // si la visite se trouve dans la periode selectionnee
                    $column =$fav->getDate()->format('F Y');            
                    $i = array_search($column,$favorisDate);
                    $favorisNumber[$i]+=1;
                    }
                }      
            $n=array_sum(($favorisNumber));
        }
        return new JsonResponse([
                'months'=>$months,
                'Date'=> $favorisDate,
                'Number' => $favorisNumber,
                'Names'=>$Names,
                'n' => json_encode($n),
                'CompanyId' => json_encode($CompanyId),
                'number' =>$number,
                'Company' => json_encode($company),
        ]);

    }

     /**
     * @Route("/StatistiquesProduitsClics/{id}", name="StatistiquesProduitsClics")
     */
    public function StatistiquesProduitsClics(ProductClickRepository $PCRepo,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findOneBy(['id' => $this->getUser()->getId()]);
        $CompanyId = $this->getUser()->getId();
        $produitclics = $em->getRepository(ProductClick::class)->findBy(['company' => $company->getId() ],['date' => 'ASC']);
        $produitclicsDate=[];
        $produitclicsNumber=[]; 
        $produitclicsName=[]; 

        $format = 'Y-m-d';
        $today = date("Y-m-d");
        $date = \DateTime::createFromFormat($format,$today); // on recupere la date d'aujourd'hui 
        $vardate = \DateTime::createFromFormat($format,$today); // on en recupere une 1ere copie
        $n=0;
        $number=0;

        $em = $this->getDoctrine()->getManager();
        $conn = $em -> getConnection();
        $months = $request->get('id');

        if($months==0){
            date_sub($vardate,date_interval_create_from_date_string('7 days'));
        }
        else if($months==1){
            if($vardate->format('d') > 28){
                date_sub($vardate,date_interval_create_from_date_string("3 days"));
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." month"));
            } else{
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." month"));
            }

        }
        else {
            if($vardate->format('d') > 28){
                date_sub($vardate,date_interval_create_from_date_string("3 days"));
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
            } else{
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
            }
        }

        if($months==0){ // si c'est une semaine on met juste les jours
            setlocale(LC_TIME, "fr_FR");
            while($vardate <= $date){ // on creer le tableau de la semaine vide
                $x = $vardate->format("l d");
                $produitclicsDate[]=$x;
                $produitclicsNumber[]=0;
                $produitclicsName[]="Aucun produit";
                date_add($vardate,date_interval_create_from_date_string('1 days'));
            }
            date_sub($vardate,date_interval_create_from_date_string('7 days'));
            foreach ($produitclics as $pc){ // on va remplir le tableau des numbers + 
                $pcDate = $pc ->getDate();
                if($vardate <= $pcDate){  // si la date du produit est dans les 7 derniers jours
                    $column = $pcDate->format("l d");
                    $i = array_search($column,$produitclicsDate);
                    if($produitclicsNumber[$i]==0){
                    $pcmax = $em->getRepository(ProductClick::class)->findOneBy(['company' => $company->getId(),'date'=>$pcDate],['number' => 'DESC']) ;
                    $produitclicsName[$i]= $pcmax->getProduct()->getName();
                    $produitclicsNumber[$i]= $pcmax->getNumber();
                    }
                }      
            }
            $n=array_sum(($produitclicsNumber));
        }
        else{ // sinon faut entasser par mois
            setlocale(LC_TIME, "fr_FR");
            while($vardate <= $date){ // on creer le tableau des mois vide
                $x = $vardate->format("F Y");
                $produitclicsDate[]=$x;
                $produitclicsNumber[]=0;
                $produitclicsName[]="Aucun produit";
                
                date_add($vardate,date_interval_create_from_date_string('1 month'));
            }
            date_sub($vardate,date_interval_create_from_date_string((strval($months)+1)." months"));
            date_sub($vardate,date_interval_create_from_date_string('1 day'));
            foreach ($produitclics as $pc){ // on va remplir le tableau des numbers + 
                $pcDate = $pc ->getDate();
                if($vardate < $pcDate){  // si la date du produit est dans la bonne periode
                    $column = $pcDate->format("F Y");
                    $i = array_search($column,$produitclicsDate);
                    if($produitclicsNumber[$i]==0){
                        $query=$this->getDoctrine()
                        ->getRepository(ProductClick::class)
                        ->createQueryBuilder('pc')
                        ->select('sum(pc.number) as number,(pc.product) as product_id')
                        ->where('pc.date >= :pcdate') 
                        ->setParameter('pcdate', $pcDate)
                        ->andWhere('month(pc.date) = :pcmois') 
                        ->setParameter('pcmois', $pcDate->format("m"))
                        ->andWhere('year(pc.date) = :pcan') 
                        ->setParameter('pcan', $pcDate->format("Y"))
                        ->groupBy('pc.product')
                        ->orderBy('number','DESC')
                        ->setMaxResults(1)
                        ->getQuery()
                        ->getResult();

                        $x = $em->getRepository(Product::class)->findOneBy(['id' => $query[0]["product_id"]]);
                        if($x != null){
                             $x = $x->getName();
                             $produitclicsName[$i]= $x;
                             $produitclicsNumber[$i]= $query[0]["number"];
                        }




                    }
                }      
            }     
            $n=array_sum(($produitclicsNumber));
        }
        return new JsonResponse([
            'months'=>$months,
            'Date'=> $produitclicsDate,
            'Number' => $produitclicsNumber,
            'Names'=>$produitclicsName,
            'n' => json_encode($n),
            'CompanyId' => json_encode($CompanyId),
            'number' =>$number,
            'Company' => $company
        ]);
    }

    /**
     * @Route("/StatistiquesProduitsComments/{id}", name="StatistiquesProduitsComments")
     */
    public function StatistiquesProduitsComments(VisiteRepository $VisitsRepo,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->findOneBy(['id' => $this->getUser()->getId()]);
        $CompanyId = $this->getUser()->getId();
        $produits = $em->getRepository(Product::class)->findBy(['company' => $company->getId()]);
        $comments = new ArrayCollection() ;
        foreach($produits as $prod){
            foreach($prod->getProductComments() as $comment){
                    $comments[] = $comment ; // on recupere la liste de tous les productcomments associés au produit de notre company
            }
        }

        $produitcommentsDate=[];
        $produitcommentsNumber=[]; 
        $produitcommentsName=[]; 

        $format = 'Y-m-d';
        $today = date("Y-m-d");
        $date = \DateTime::createFromFormat($format,$today); // on recupere la date d'aujourd'hui 
        $vardate = \DateTime::createFromFormat($format,$today); // on en recupere une 1ere copie
        $n=0;
        $number=0;

        $em = $this->getDoctrine()->getManager();
        $conn = $em -> getConnection();
        $months = $request->get('id');

        if($months==0){
            date_sub($vardate,date_interval_create_from_date_string('7 days'));
        }
        else if($months==1){
            if($vardate->format('d') > 28){
                date_sub($vardate,date_interval_create_from_date_string("3 days"));
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." month"));
            } else{
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." month"));
            }

        }
        else {
            if($vardate->format('d') > 28){
                date_sub($vardate,date_interval_create_from_date_string("3 days"));
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
            } else{
                date_sub($vardate,date_interval_create_from_date_string(strval($months)." months"));
            }
        }

        if($months==0){ // si c'est une semaine on met juste les jours
            setlocale(LC_TIME, "fr_FR");
            while($vardate <= $date){ // on creer le tableau de la semaine vide
                $x = $vardate->format("l d");
                $produitcommentsDate[]=$x;
                $produitcommentsNumber[]=0;
                $produitcommentsName[]="Aucun produit";
                date_add($vardate,date_interval_create_from_date_string('1 days'));
            }
            date_sub($vardate,date_interval_create_from_date_string('7 days'));
            foreach ($comments as $comment){ // on va remplir le tableau des numbers + 
                $commentDate = $comment ->getCreatedAt();
                if($vardate <= $commentDate){  // si la date du produit est dans les 7 derniers jours
                    $column = $commentDate->format("l d");
                    $i = array_search($column,$produitcommentsDate);
                    if($i!=false){
                        if($produitcommentsNumber[$i]==0){
                            $query=$this->getDoctrine()
                                ->getRepository(ProductComment::class)
                                ->createQueryBuilder('pc')
                                ->select('count(pc.product) as number,(pc.product) as product_id')
                                ->where('pc.createdAt = :pcdate') 
                                ->setParameter('pcdate', $commentDate)
                                ->groupBy('pc.product')
                                ->orderBy('number','DESC')
                                ->setMaxResults(1)
                                ->getQuery()
                                ->getResult();  
                                //dd($query);    
                            $x = $em->getRepository(Product::class)
                                ->findOneBy(['id' => $query[0]["product_id"]]) 
                                ->getName();
                                //dump($x);
                            $produitcommentsName[$i]= $x;
                            $produitcommentsNumber[$i]= $query[0]["number"];
                        }
                    }
                    
                }      
            }
            $n=array_sum(($produitcommentsNumber));
        }
        else{ // sinon faut entasser par mois
            setlocale(LC_TIME, "fr_FR");
            while($vardate <= $date){ // on creer le tableau des mois vide
                $x = $vardate->format("F Y");
                $produitcommentsDate[]=$x;
                $produitcommentsNumber[]=0;
                $produitcommentsName[]="Aucun produit";
                
                date_add($vardate,date_interval_create_from_date_string('1 month'));
            }
            date_sub($vardate,date_interval_create_from_date_string((strval($months)+1)." months"));
            date_sub($vardate,date_interval_create_from_date_string('1 day'));
            foreach ($comments as $comment){ // on va remplir le tableau des numbers + 
                $commentDate = $comment ->getCreatedAt();
                if($vardate < $commentDate){  // si la date du produit est dans la bonne periode
                    $column = $commentDate->format("F Y");
                    $i = array_search($column,$produitcommentsDate);
                    if($i!=false){
                        if($produitcommentsNumber[$i]==0){
                            /*
                            $db=$this->getDoctrine()
                                ->getRepository(ProductComment::class)
                                ->createQueryBuilder('pc')
                                ->select('min(pc.createdAt) as date')
                                ->where('month(pc.createdAt) = :pcmois') 
                                ->setParameter('pcmois', $commentDate->format("m"))
                                ->andWhere('year(pc.createdAt) = :pcan') 
                                ->setParameter('pcan', $commentDate->format("Y"))
                                ->getQuery()
                                ->getResult();
                            $datemin = $db[0]["date"];  // on recupere la plus petite date de la bdd du mois en question
                            */
                            $yearmin = $commentDate->format("Y") ;
                            $monthmin = $commentDate->format("m") ;
                            $datemin = $yearmin."-".$monthmin."-01" ;    

                            $query=$this->getDoctrine()
                                ->getRepository(ProductComment::class)
                                ->createQueryBuilder('pc')
                                ->select('count(pc.product) as number,(pc.product) as product_id')
                                ->where('pc.createdAt >= :pcdate') 
                                ->setParameter('pcdate', $datemin)
                                ->andWhere('month(pc.createdAt) = :pcmois') 
                                ->setParameter('pcmois', $commentDate->format("m"))
                                ->andWhere('year(pc.createdAt) = :pcan') 
                                ->setParameter('pcan', $commentDate->format("Y"))
                                ->groupBy('pc.product')
                                ->orderBy('number','DESC')
                                ->setMaxResults(1)
                                ->getQuery()
                                ->getResult();  
 
                            $x = $em->getRepository(Product::class)
                                ->findOneBy(['id' => $query[0]["product_id"]]) 
                                ->getName();
                            $produitcommentsName[$i]= $x;
                            $produitcommentsNumber[$i]= $query[0]["number"];
                        }
                    }
                }      
            }     
            $n=array_sum(($produitcommentsNumber));
        }

        return new JsonResponse([
            'months'=>$months,
            'Date'=> $produitcommentsDate,
            'Number' => $produitcommentsNumber,
            'Names'=>$produitcommentsName,
            'n' => json_encode($n),
            'CompanyId' => json_encode($CompanyId),
            'number' =>$number,
            'Company' => $company
        ]);
    }
    //fin du controller
}
