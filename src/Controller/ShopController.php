<?php

namespace App\Controller;


use App\Entity\Ads;
use App\Entity\Cart;
use App\Entity\CommentProductFav;
use App\Entity\Order;
use App\Entity\Post;
use App\Entity\PostCategory;
use App\Entity\PostComment;
use App\Entity\PostLike;
use App\Entity\ProductAds;
use App\Entity\ProductComment;
use App\Entity\Subcategory;
use App\Entity\TarifAdsUser;
use App\Form\OrderType;
use App\Entity\User;
use App\Entity\Cartline;


use Doctrine\ORM\EntityManagerInterface;

use App\Repository\ProductRepository;
use App\Repository\SubcategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Product;
use App\Form\PostType;
use App\Repository\PostLikeRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Company;
use App\Entity\Category;
use App\Entity\Marchandise;
use App\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration;
use Symfony\Component\HttpFoundation\Request;
use Cocur\Slugify\Slugify;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Query\Expr\Join;




class ShopController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session, \Knp\Snappy\Pdf $knpSnappy,EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->knpSnappy = $knpSnappy;
        $this -> em = $em ;
    }
    public function getProductAds(){
        //$em = $this->getDoctrine()->getManager();
        $productAds = $this->em->getRepository(ProductAds::class)->findAll();

        return $productAds;
    }

    //ads selon pack ici
    public function displayallAdsbyPacks() // ok
    {

        $myTarifAds = $this->em->getRepository(TarifAdsUser::class)->findAll();
        //dump($this->em->getRepository(TarifAdsUser::class));
        //dd($myTarifAds = $this->em->getRepository(Ads::class));
        return $myTarifAds;
        
    }
    public function getcssStyleifExistsByPack() // que fait cette fonction ?
    {
        $em = $this->getDoctrine()->getManager();
        $mycssbypack = $em->getRepository(TarifAdsUser::class)
            ->createQueryBuilder('p')
            ->select("p, c,u")
            ->leftJoin('p.adv', 'c')
            ->leftJoin('p.tarif', 'u')
            ->getQuery()
            ->getArrayResult();
        return $mycssbypack;
    }
    public function AfficheAction(Request $a) // affichage classique de la page
    {

        $em = $this->getDoctrine()->getManager();

        $adsbyPack=$this->displayallAdsbyPacks();
        $cssbyPack=$this->getcssStyleifExistsByPack();

        $ads = $em -> getRepository(Ads::class)->findAll();
        $productAds= $this->getProductAds();
        $cats = $em->getRepository(Category::class)->findAll();
        $subcats = $em->getRepository(Subcategory::class)->findAll();
        
        $idcompany = $this->getUser() ;
        $products = $this->em ->getRepository(Product::class)->findAll();

        $items = $this->countItemsinBasket();
        $clInBasket = $this->clInBasket();
        $productsInBasket = $this->ProductsinBasket();
        $rep = $this -> clInProduct();

        //dump($clInBasket);
        //dd($rep);

        $test = $this->recupSubCat(1);
        //dd($test);
        
       /* $list = $em
        ->getRepository(Product_Subcategory::class)
        ->findBy(['product' => $id]); // on cherche le panier du user
        */

        $totalCart = 0;
        foreach ($clInBasket as $cl){
            $qte = $cl -> getQuantity();
            $price = $cl -> getProduit() -> getPrice() ;
            $totalCart += $qte*$price ;
        }

        /* $test = new ArrayCollection();
        foreach ($productsInBasket[1]->getSubcategories() as $subcategory) {
            $test->add($subcategory);
        }
        dump($test);
        dd($productsInBasket[1]->getSubcategories()); */

        return $this->render('shop/products.html.twig', array("products" => $products,
            "items" => $items,
            "productAds"=>$productAds,
            "ads"=>$ads,
            "adsbyPack"=>$adsbyPack,
            "productsInBasket"=>$productsInBasket,
            'totalCart'=>$totalCart,
            'clInBasket'=>$clInBasket,
            "cats"=>$cats,
            "z"=>0,
            "subcats"=>$subcats));
    }

    public function FocusProduct(Product $product,Request $request)
    {
        $res = $product->getCartlines() ;
        dd($res);
        return $res ;  
    }

    public function addProductToCart(Request $request) // ajoute un produit a la cart
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $product = $em
            ->getRepository(Product::class)
            ->findOneBy(['id'=>$id]);
        
        $cart = $em
            ->getRepository(Cart::class)
            ->findOneBy(['creator'=>$user]);
        
        if($cart==null){
            $cart = new Cart() ;
            $cart->setCreator($user);
            $cart->setCreatedAt(new \DateTime('now'));
        }
        
        $cartline = $em
            ->getRepository(Cartline::class)
            ->findOneBy(['panier'=>$cart->getId(),'produit'=>$product->getId()]);

        if($cartline==null){
                $cartline = new Cartline() ;
                $cart->addCartline($cartline);
                $product->addCartline($cartline);
                $cartline ->setQuantity(1);
            }
        else{
            $qte = $cartline -> getQuantity();
            $cartline ->setQuantity($qte+1);
        }

        $em->persist($cart);
        $em->flush();

        return $this->redirectToRoute('Shop');

    }

public function increaseQte(Request $request) // on augmente la quantité en cliquant sur le bouton plus
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $cl = $em
            ->getRepository(Cartline::class)
            ->findOneBy(['id'=>$id]);

        $qte = $cl -> getQuantity();
        $cl ->setQuantity($qte+1); 

        $em->persist($cl); 
        $em->flush();

        $clInBasket = $this->clInBasket();
        $totalCart = 0;
        foreach ($clInBasket as $x){
            $quant = $x -> getQuantity();
            $price = $x-> getProduit() -> getPrice() ;
            $totalCart += $quant*$price ;
        }

        return new JsonResponse(['quantity' => $qte+1,"total"=>$totalCart]); // faire du ajax pour ne pas quitter le panier ouvert
    }

    public function decreaseQte(Request $request) // on réduit la quantité en cliquant sur le bouton moins
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $cl = $em
            ->getRepository(Cartline::class)
            ->findOneBy(['id'=>$id]);
        $qte = $cl -> getQuantity();

        if($qte!=1){
            $cl ->setQuantity($qte-1); 
            $em->persist($cl); 
            $em->flush();
        } 
        else{
            $em->remove($cl);
            $em->flush();
        }

        $items = $this -> countItemsinBasket();
        $clInBasket = $this->clInBasket();
        $totalCart = 0;
        foreach ($clInBasket as $x){
            $quant = $x -> getQuantity();
            $price = $x-> getProduit() -> getPrice() ;
            $totalCart += $quant*$price ;
        }

        return new JsonResponse(['quantity' => $qte-1,'items'=>$items,"total"=>$totalCart]); // faire du ajax pour ne pas quitter le panier ouvert
       
    }

    public function countItemsinBasket() // compte les items dans un panier
    {   
        $iduser = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        $panier = $em
        ->getRepository(Cart::class)
        ->findOneBy(['creator' => $iduser]); // on cherche le panier du user
       
        if($panier != null){
            $listcl = $panier -> getCartlines() ; // on recupere la collection des cartlines
            return count($listcl);
        }
        else{return 0;}
       
    }

    public function recupSubCat($id) // recup les subcategories d'un produit donné
    {   
        $em = $this->getDoctrine()->getManager();

        $conn = $em -> getConnection();

        $sql = // on recupere un tableau contenant tous les id des subcat
            '
            SELECT subcategory_id FROM product_subcategory rel
            WHERE rel.product_id = :id
            ';
        $que = $conn->prepare($sql);
        $que->execute(['id' => 1]);
        $list_id = $que->fetchAllAssociative();

        $subcategories = new ArrayCollection(); // on crée un tableau vide
       
        if($list_id != null){ // si la liste des id n'est pas vide alors :   
            foreach($list_id as $elem){ // pour chaque id de subcat present
                $x = $em ->getRepository(Subcategory::class) ->findOneBy(['id'=>$elem]); // on recupere la subcat ( l'objet )
                $subcategories -> add($x); // on ajoute la subcat au tableau
            }
        }
        return $subcategories ;    
    }

    public function clInProduct() // retourne toutes les cartlines d'un produit
    {
        $em = $this->getDoctrine()->getManager();

        $product = $em
        ->getRepository(Product::class)
        ->findOneBy(['id' => 39]); // on cherche le produit
         //dd($product) ;
        if($product != null){
            $listcl = $product -> getCartlines() ; // on recupere la collection des cartlines
        }
        else{$listcl = new ArrayCollection() ;}
        return $listcl ;    
    }

    public function ProductsinBasket() // retourne un tableau de produits contenu dans un panier
    {
        $iduser = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        $panier = $em
        ->getRepository(Cart::class)
        ->findOneBy(['creator' => $iduser]); // on cherche le panier du user
        $products = new ArrayCollection(); // on crée un tableau vide

        if($panier != null){
            $listcl = $panier -> getCartlines() ; // on recupere la collection des cartlines
            foreach ($listcl as $cl){
                $products -> add($cl->getProduit()); // on ajoute les produits un à un au tableau
            }
        }
        return $products;
    }
    public function clInBasket() // retourne toutes les cartlines d'un panier
    {
        $iduser = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        $panier = $em
        ->getRepository(Cart::class)
        ->findOneBy(['creator' => $iduser]); // on cherche le panier du user
       
        if($panier != null){
            $listcl = $panier -> getCartlines() ; // on recupere la collection des cartlines
        }
        else{$listcl = new ArrayCollection() ;}
        return $listcl ;    
    }

    public function OrderAction(Request $request) // commander
    {
        
        $em = $this->getDoctrine()->getManager();
        $iduser = $this->getUser()->getId();

        $order = new Order();

        $clInBasket = $this->clInBasket();
        $productsInBasket = $this->ProductsinBasket();

        
        $this->session->set('total',0);
        $total = 0;

        foreach ($clInBasket as $cl){
            $qte = $cl -> getQuantity() ;
            $price = $cl->getProduit()->getPrice();
            $total += $qte*$price ;
        }

        $this->session->set('total',$total);
        $myOrders = $clInBasket ;
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $order->setProducts($productsInBasket);
            dd($order) ;
            $order->setCreator($this->getUser());
            $order->setShipping('Paiement à la livraison');
            $this->session->set('total',0);
            $order->setTotal($total);
            $order->setStatus('pending');
            $order->setCreatedAt(new \DateTime('now'));
            $em->persist($order);
            $em->flush();
            $this->addFlash('success', 'Création avec succés !');
            
        }

        return $this->render('shop/order.html.twig', array(
            "myOrders" => $myOrders,  
            "total"=>$total,
            "Form" => $form->createView()
        ));

    }

    public function deleteFromCartAction(Request $request) // supprime une cartline
    {
        $idcl = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $cl = $em
            ->getRepository(Cartline::class)
            ->find($idcl);
        $em->remove($cl);
        $em->flush();

        $items = $this -> countItemsinBasket();
        $clInBasket = $this->clInBasket();
        $totalCart = 0;
        foreach ($clInBasket as $x){
            $quant = $x -> getQuantity();
            $price = $x-> getProduit() -> getPrice() ;
            $totalCart += $quant*$price ;
        }
        return new JsonResponse(['items'=>$items,"total"=>$totalCart]);
    }


    public function searchProduct(ProductRepository $repository, Request $request)
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        [$min, $max] = $repository->findMinMax($data);
        //  dd($data);

        $products=$repository->findSearch($data);
        return $this->render('shop/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
            'min' => $min,
            'max' => $max
        ]);
    }

    public function deleteCOmmentFromProduct(Request $request)
    {
        $ref = $request->headers->get('referer');
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $Product = $em
            ->getRepository(ProductComment::class)
            ->find($id);
        $em->remove($Product);
        $em->flush();

        $this->addFlash(
            'success', 'Commentaire supprimé !.'
        );

        return $this->redirect($ref);
    }


    public function ProductsByCategoryAction($id) // quelle est cette fonction ?
    {
        $products=$this->getDoctrine()
            ->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->select("p, c,u")
            ->leftJoin('p.company', 'c')
            ->leftJoin('p.category', 'u')
            ->where('p.category = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $cats=$this->getDoctrine()
            ->getRepository(Category::class)
            ->createQueryBuilder('q')
            ->select("q")
            ->getQuery()
            ->getArrayResult();
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(Category::class)->find($id);
        return $this->render('shop/ProductsByCategory.html.twig'
            ,array(
                "products"=>$products,
                "cats"=>$cats,
                'name'=>$cat->getName(),
            ));
    }

    public function PayWithStripeAction(Request  $request){
        $order = new Order();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $products = $request->request->get('products');
        $items=  $this->countItemsinBasket();
        $total = $this->session->get('total');
        foreach ($total as $tot){
            $tot['total_sum'];
            $theTotal=$tot['total_sum'];
        }

        \Stripe\Stripe::setApiKey("sk_test_51IfLeDJJkXu5mowcDQfluMkL4tXDjYnH7o2chkKqgNnBHYyVzRgytKyqg2gu4A3Z92hl6I2C0yjITmIBQy0pcFBn00qqVPn7q8");
        \Stripe\Charge::create(array(
            "amount" =>$theTotal*100,
            "currency"=>"eur",
            "source"=>$request->get('stripeToken'),
            "description"=>"Paiement de test"
        ));
        $myOrders = $this->ProductsinBasket();

        foreach ($myOrders as $myord) {
            $prosName=$myord->getProduct()->getName();
            //$prosprice=  $myord->getProduct()->getPrice();


        }
        $order->setStatus('pending');
        $order->setCreator($user);
        $order->setCreatedAt(new \DateTime('now'));
        $order->setProducts($prosName);
        $order->setAddress('Ariana');
        $order->setTotal($theTotal);
        $order->setShipping('Paiement avec la carte');
        $em->persist($order);
        $em->flush();
        return $this->render('shop/thanks.html.twig');
    }

    public function UsersOrddersAction() // Que fait cette fonction
    {
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository(Order::class)
            ->createQueryBuilder('q')
            ->where('q.creator = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        return $this->render('shop/Userorders.html.twig'
            ,array(
                "orders"=>$orders

            ));
    }



    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $products =  $em->getRepository('App:Product')->findEntitiesByString($requestString);
        if(!$products) {
            $result['products']['error'] = "Aucun résultat trouvé 😞 ";
        } else {
            $result['products'] = $this->getRealEntities($products);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($products){
        foreach ($products as $products){
            $realEntities[$products->getId()] = [$products->getImage(),$products->getName()];

        }
        return $realEntities;
    }

    public function DisplayProductsByCompany($id) // quel est l'interet de la fonction ?
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class)
            ->createQueryBuilder('q')
            ->select("q, c")
            ->where('q.company = :id')
            ->leftJoin('q.category', 'c')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();


        return $this->render('shop/ProductsByCompany.html.twig', array("products" => $products));

    }


    public function pdfAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository(Order::class)->find(array('id'=>$id));


        $html = $this->renderView('shop/pdfOrder.html.twig', array('commande'=>$commande));




        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->knpSnappy->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename)
            ]
        );
    }

    public function ShowdetailedProdAction($id){ // inutilisée ailleurs dans le controller
        $em = $this->getDoctrine()->getManager();
        $an = $em->getRepository(Product::class)->find($id);
        return $this->render('shop/productDetails.html.twig', array(
            'name'=>$an->getName(),
            'price'=>$an->getPrice(),
            'category'=>$an->getCategory(),
            'description'=>$an->getDescription(),
            'company',$an->getCompany(),
            'image'=>$an->getImage(),
            'products'=>$an,
            'id'=>$id
        ));
    } 

    
    

    public function addCommentAction(Request $request, UserInterface $user) // inutilisée ailleurs dans le controller
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->findOneBy( array('id' => $request->request->get('product_id') ) );
        $productSlug = $product->getSlug();
        $ref = $request->headers->get('referer');

        $annonce = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findProductByid($request->request->get('product_id'));

        $comment = new ProductComment();

        $comment->setCreator($user);
        $comment->setProduct($annonce);
        $comment->setComment($request->request->get('comment'));
        $comment->setCreatedAt(new \DateTime('now'));
        
        $em->persist($comment);
        $em->flush();

        $this->addFlash(
            'info', 'Commentaire publié !.'
        );
        //Creation du comment Fav (Dashboard)
        $user1 = $annonce->getCompany();
        $company = $em->getRepository(Company::class)->findOneBy(['id' => $user1->getId()]);
        $CompanySlug=$company->getSlug();
        
        $date=(new \DateTime());
        $commentProductFav = $em->getRepository(CommentProductFav::class)->findOneBy( ['productSlug' => $productSlug,'date' => $date,'companySlug' => $CompanySlug] );

        if ($commentProductFav==null):
            $commentProductFav = new CommentProductFav();

            $commentProductFav->setDate($date);
            $commentProductFav->setProductSlug($productSlug);
            $commentProductFav->setNumber(1);
            $commentProductFav->setCompanySlug($company->getSlug());
            $em->persist($commentProductFav);
            $em->flush();
        else :

            $commentProductFav->setNumber($commentProductFav->getNumber()+1);
            $em->persist($commentProductFav);
            $em->flush();

        endif;
        return $this->redirect($ref);

    }

    public function DisplayCartAction(Request $request) // inutile
    {
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Cart::class)
            ->createQueryBuilder('q')
            ->select("q, c")
            ->where('q.creator = :id')
            ->leftJoin('q.product', 'c')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        //sum
        $total = $em->getRepository(Cart::class)

            ->createQueryBuilder('o')
            ->select('o')
        ->leftJoin('o.product', 'op')
        ->addSelect('op')
        ->addSelect('SUM(op.price) AS total_sum')
            ->getQuery()
            ->getScalarResult();

        $this->session->set('products', $products);
        $this->session->set('total', $total);
        return $this->render('shop/cart.html.twig', array("products" => $products,
            "total"=>$total));

    }



}