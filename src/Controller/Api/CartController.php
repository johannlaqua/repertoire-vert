<?php

namespace App\Controller\Api;

use App\Entity\Cart;
use App\Entity\Cartline;
use App\Entity\Friendship;
use App\Entity\Product;
use App\Repository\CartlineRepository;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CartController extends AbstractController
{

  private $cartRepository;
  private $userRepository;
  private $productRepository;
  private $cartlineRepository;

  public function __construct(
    CartRepository $cartRepository,
    UserRepository $userRepository,
    ProductRepository $productRepository,
    CartlineRepository $cartlineRepository
  ) {
    $this->cartRepository = $cartRepository;
    $this->userRepository = $userRepository;
    $this->productRepository = $productRepository;
    $this->cartlineRepository = $cartlineRepository;
  }


  /**
   * @Route("/api/users/{id}/cart")
   * @Method({"GET"})
   */
  public function getCart($id)
  {
    // Get user current cart
    $cart = $this->cartRepository->findCurrentUserCartWithInfo($id);

    if (!$cart) {
      // Get user
      $user = $this->userRepository->findOneById($id);

      if (!$user) {
        // Return user not found error
        return new JsonResponse(array(
          'code' => Response::HTTP_NOT_FOUND,
          'message' => 'User not found',
        ));
      } else {
        // Create a new cart for user
        $newCart = new Cart();
        $newCart->setCreator($user);
        $newCart->setCreatedAt(new \DateTime());
        $newCart->setStatus('current');

        // Add to DB
        $em = $this->getDoctrine()->getManager();
        $em->persist($newCart);
        $em->flush();

        $serializer = $this->container->get('serializer');
        $response = [
          'code' => Response::HTTP_OK,
          'message' => "Cart fetched successfully",
          'cart' => $newCart,
          //'cartlines' => $cartlines
        ];
        $responseJson = $serializer->serialize($response, 'json');
        return new Response($responseJson);
      }
    } else {

      // Get cart cartlines, if any
      //$cartlines = $this->cartlineRepository->findByCartId($cart->getId());

      // Return user cart
      //$serializer = $this->container->get('serializer');
      //$cartJson = $serializer->serialize($cart, 'json');

      //return new Response($cartJson, Response::HTTP_OK);

      $serializer = $this->container->get('serializer');
      $response = [
        'code' => Response::HTTP_OK,
        'message' => "Cart fetched successfully",
        'cart' => $cart[0],
        //'cartlines' => $cartlines
      ];
      $responseJson = $serializer->serialize($response, 'json');
      return new Response($responseJson);
    }
  }


  /**
   * @Route("/api/users/{userId}/cartProducts/{productId}", methods={"GET"})
   */
  public function getProductCartline($userId, $productId)
  {
    // Get user current cart and product
    $cart = $this->cartRepository->findCurrentUserCart($userId);
    $product = $this->productRepository->findProductByid($productId);

    if (!$cart || !$product) {
      // Return product or cart not found error
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User cart or product not found',
      ));
    } else {
      // Find cartline with cart id and product id
      $cartline = $this->cartlineRepository->findOneBy([
        'panier' => $cart->getId(),
        'produit' => $productId
      ]);

      if (!$cartline) {
        // Return product is not in cart
        return new JsonResponse(array(
          'code' => Response::HTTP_NOT_FOUND,
          'message' => 'Product is not in cart',
        ));
      } else {
        // Return cartline with this product
        $serializer = $this->container->get('serializer');
        $cartlineJson = $serializer->serialize($cartline, 'json');

        return new Response($cartlineJson, Response::HTTP_OK);
      }
    }
  }


  /**
   * @Route("/api/users/{userId}/cartProducts/{productId}", name="api_add_to_cart", methods={"POST"})
   */
  public function addToCart(Request $request, $userId, $productId)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user current cart and product
    $cart = $this->cartRepository->findCurrentUserCart($userId);
    $product = $this->productRepository->findProductByid($productId);

    if (!$cart || !$product) {
      // Return product or cart not found error
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User cart or product not found',
      ));
    } else {
      // Find cartline with cart id and product id
      $cartline = $this->cartlineRepository->findOneBy([
        'panier' => $cart->getId(),
        'produit' => $productId
      ]);

      // Entity Manager
      $em = $this->getDoctrine()->getManager();

      if (!$cartline) {
        // Create new cartline with this product
        $newCartline = new Cartline();
        $newCartline->setPanier($cart);
        $newCartline->setProduit($product);
        $newCartline->setQuantity($parameters['quantity']);

        // Add to DB
        $em->persist($newCartline);
        $em->flush();

        // Return cartline with this product
        $serializer = $this->container->get('serializer');
        $response = [
          'status' => 200,
          'content' => $newCartline
        ];
        $cartlineJson = $serializer->serialize($response, 'json');

        return new Response($cartlineJson, Response::HTTP_OK);
      } else {
        // Increment quantity of cartline with this product
        $cartline->setQuantity($cartline->getQuantity() + $parameters['quantity']);

        // Update DB
        $em->flush();

        return new JsonResponse(array(
          'status' => Response::HTTP_OK,
          'content' => 'Product added successfully',
        ));
      }
    }
  }


  /**
   * @Route("/api/users/{userId}/cartProducts/{productId}/{removeType}", methods={"DELETE"})
   */
  public function removeFromCart($userId, $productId, $removeType)
  {
    // Get user current cart and product
    $cart = $this->cartRepository->findCurrentUserCart($userId);
    $product = $this->productRepository->findProductByid($productId);

    if (!$cart || !$product) {
      // Return product or cart not found error
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User cart or product not found',
      ));
    } else {
      // Find cartline with cart id and product id
      $cartline = $this->cartlineRepository->findOneBy([
        'panier' => $cart->getId(),
        'produit' => $productId
      ]);

      if (!$cartline) {
        return new JsonResponse(array(
          'code' => Response::HTTP_NOT_FOUND,
          'message' => 'Product in cart not found',
        ));
      } else {

        // Entity manager
        $em = $this->getDoctrine()->getManager();

        if ($removeType === 'single') {
          // Decrease quantity of cartline with this product
          $cartline->setQuantity($cartline->getQuantity() - 1);
        } else {
          // Completely remove product from cart
          $em->remove($cartline);
        }

        // Update DB
        $em->flush();

        return new JsonResponse(array(
          'code' => Response::HTTP_OK,
          'message' => 'Product removed successfully',
        ));
      }
    }
  }


  /**
   * @Route("/api/users/{userId}/carts/{cartId}/{status}", methods={"PUT"})
   */
  public function changeCartStatus(Request $request, $userId, $cartId, $status)
  {
    // Get user cart / order
    $cart = $this->cartRepository->findOneBy(['id' => $cartId]);

    if (!$cart) {
      // Return user not found error
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'content' => 'Order not found',
      ));
    }

    // Valid status values
    $validStatus = array("current", "confirmed", "in transit", "delivered");

    if (!in_array($status, $validStatus, true)) {
      // Return invalid status error
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'content' => 'Status is not valid',
      ));
    }

    // Change cart / order status
    $cart->setStatus($status);

    // Update confirmation date time and total
    if ($status === "confirmed") {

      // Get order total from request parameters
      $parameters = json_decode($request->getContent(), true);
      $total = $parameters['total'];

      $cart->setTotal($total);
      $cart->setCreatedAt(new \DateTime());
    }

    // Update DB
    $em = $this->getDoctrine()->getManager();
    $em->flush();

    // Return user cart
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => 200,
      'content' => $cart
    ];
    $cartJson = $serializer->serialize($response, 'json');

    return new Response($cartJson, Response::HTTP_OK);
  }
}
