<?php

namespace App\Controller\Api;



use App\Entity\Cart;
use App\Entity\Category;
use App\Entity\Company;
use App\Entity\Order;
use App\Entity\Product;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class ShopController  extends AbstractController
{
    /**
     * @Route("/rest/shopProducts",name="shop_products")
     * @Method({"GET"})
     */
    public function getAll()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->createQueryBuilder('q')
            ->select("q, c")
            ->leftJoin('q.company', 'c')
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($products));

        return $response;

    }
    /**
     * @Route("/api/addProductToCart/{idProd}",name="addProduct_To_Cart")
     * @Method({"POST"})
     */
    public function addProductToCart(Request $request, TokenStorageInterface $tokenStorage,$idProd,$serializer)
    {
        //$user= $this->getUser();

        $body = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)
            ->find($idProd);
        $user = $this->get("security.token_storage")->getToken()->getUser();
        $data = $serializer->deserialize($body, Cart::class, 'json');
        $cart = new Cart();
        // $user = $em->getRepository(User::class)->find($id);
        $cart->setCreator($user);
        $cart->setProduct($product);
        $cart->setCreatedAt(new \DateTime('now'));

        $em->persist($cart);

        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'Product Added to Cart!',
            'errors' => null,
            'result' => $data

        );
        return new JsonResponse($response, 200);

    }

    /**
     * @Route("/api/getCartByUser/{id}",name="get_cart_by_user")
     * @Method({"GET"})
     */
    public function getCartByUser($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $notifications = $this->getDoctrine()
            ->getRepository(Cart::class)
            ->createQueryBuilder('p')
            ->select("p, c, u")
            ->leftJoin('p.product', 'c')
            ->leftJoin('p.creator', 'u')
            ->where('p.creator = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $response->setContent(json_encode($notifications));
        return $response;
    }

    /**
     * @Route("/api/addOrder",name="addOrderUser")
     * @Method({"POST"})
     */
    public function addOrder(Request $request, TokenStorageInterface $tokenStorage,SerializerInterface $serializer)
    {
        //$user= $this->getUser();

        $body = $request->getContent();
        $em = $this->getDoctrine()->getManager();

        $user = $this->get("security.token_storage")->getToken()->getUser();
        $data = $serializer->deserialize($body, Order::class, 'json');
        $order = new Order();
        // $user = $em->getRepository(User::class)->find($id);
        $order->setCreator($user);
        $order->setStatus('pending');
        $order->setProducts($data->getProducts());
        $order->setAddress($data->getAddress());
        $order->setCreatedAt(new \DateTime('now'));

        $em->persist($order);

        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'Product Added to Cart!',
            'errors' => null,
            'result' => $data

        );
        return new JsonResponse($response, 200);

    }


    /**
     * @Route("/rest/getOneProduct/{id}")
     */
    public function getOneProduct($id)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $post=$this->getDoctrine()
            ->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->select("p, c, u")
            ->leftJoin('p.category', 'c')
            ->leftJoin('p.company', 'u')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($post));

        return $response;
    }

    /**
     * @Route("/api/deleteFromCart/{id}",name="delete_pro_from_cart")
     * @Method({"DELETE"})
     */
    public function deleteFromCart($id)
    {

        $cart = $this->getDoctrine()->getRepository(Cart::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($cart);
        $em->flush();

        $response = array(

            'code' => 0,
            'message' => 'Product  deleted from cart!',
            'errors' => null,
            'result' => null

        );
        return new JsonResponse($response, 200);
    }

    /**
     * @Route("/api/addProductCompany/{idCat}/{idComp}",name="addProductCompany")
     * @Method({"POST"})
     */
    public function addProductToShop(Request $request, TokenStorageInterface $tokenStorage,$idCat,$idComp,SerializerInterface $serializer)
    {
        //$user= $this->getUser();

        $body = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $user = $this->get("security.token_storage")->getToken()->getUser();
        $data = $serializer->deserialize($body, Product::class, 'json');
        $service = new Product();

        $category = $em->getRepository(Category::class)->find($idCat);
        $company = $em->getRepository(Company::class)->find($idComp);
        $service->setDescription($data->getDescription());
        $service->setOwner($user);
        $service->setCategory($category);
        $service->setCompany($company);
        $service->setSlug($data->getSlug());
        $service->setCertification($data->getCertification());
$service->setImage($data->getOwner());
$service->setCreationdate(new \DateTime('now'));
$service->setUpdateddate(new \DateTime('now'));
$service->setLatitude($data->getLatitude());
$service->setLongitude($data->getLongitude());
$service->setOrigin($data->getOrigin());
$service->setWantevaluation($data->isWantevaluation());
$service->setName($data->getName());
$service->setPrice($data->getPrice());
$service->setCurrency($data->getCurrency());
$service->setImage($data->getImage());
$service->setGaearecommanded(false);

        $em->persist($service);

        $em->flush();

        $response = array(
            'code' => 0,
            'message' => 'Post created!',
            'errors' => null,
            'result' => $data

        );
        return new JsonResponse($response, 200);

    }


    /**
     * @Route("/api/productsByCompany/{owner}")
     */
    public function getProductsByCompany($owner)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $services = $this->getDoctrine()
            ->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->select("p, c,u")
            ->leftJoin('p.category', 'c')
            ->leftJoin('p.company', 'u')
            ->where('p.owner = :id')
            ->setParameter('id', $owner)
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($services));

        return $response;

    }


    /**
     * @Route("/api/deleteProductFromCompany/{id}",name="delete_pro_from_comp")
     * @Method({"DELETE"})
     */
    public function deleteProductfromCompany($id)
    {

        $cart = $this->getDoctrine()->getRepository(Product::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($cart);
        $em->flush();

        $response = array(

            'code' => 0,
            'message' => 'Product  deleted !',
            'errors' => null,
            'result' => null

        );
        return new JsonResponse($response, 200);
    }
    /**
     * @Route("/api/userorders",name="userOrders")
     * @Method({"GET"})
     */
    public function UsersOrddersAction()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $id = $this->getUser()->getId();
        $services = $this->getDoctrine()
            ->getRepository(Order::class)
            ->createQueryBuilder('p')
            ->select("p")
            ->where('p.creator = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();

        $response->setContent(json_encode($services));

        return $response;
    }

    /**
     * @Route("/api/payWithStripe",name="payWithStripe")
     * @Method({"POST"})
     */
    public function PayWithStripeAction(Request  $request){
        $order = new Order();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();


        \Stripe\Stripe::setApiKey("sk_test_51IfLeDJJkXu5mowcDQfluMkL4tXDjYnH7o2chkKqgNnBHYyVzRgytKyqg2gu4A3Z92hl6I2C0yjITmIBQy0pcFBn00qqVPn7q8");
        \Stripe\Charge::create(array(
            "amount" =>200,
            "currency"=>"eur",
            "source"=>$request->get('stripeToken'),
            "description"=>"Paiement de test"
        ));



        $order->setStatus('pending');
        $order->setCreator($user);
        $order->setCreatedAt(new \DateTime('now'));
        $order->setProducts('testionic');
        $order->setAddress('Ariana');
        $order->setTotal(200);
        $order->setShipping('Paiement avec la carte');
        $em->persist($order);
        $em->flush();
        $response = array(

            'code' => 0,
            'message' => 'Success Paement !',
            'errors' => null,
            'result' => null

        );
        return new JsonResponse($response, 200);
    }
}