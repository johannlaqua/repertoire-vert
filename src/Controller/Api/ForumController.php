<?php

namespace App\Controller\Api;




use App\Entity\Post;
use App\Entity\Category;
use App\Entity\PostComment;
use App\Entity\PostCommentLike;
use App\Entity\PostLike;
use App\Entity\ServiceOfferUser;
use App\Repository\CategoryRepository;
use App\Repository\PostCommentLikeRepository;
use App\Repository\PostCommentRepository;
use App\Repository\PostsRepository;
use App\Repository\UserRepository;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class ForumController extends AbstractController
{
  private $session;
  private $userRepository;
  private $postsRepository;
  private $postCommentRepository;
  private $postCategoryRepository;
  private $postCommentLikeRepository;

  public function __construct(
    UserRepository $userRepository,
    PostsRepository $postsRepository,
    PostCommentRepository $postCommentRepository,
    categoryRepository $categoryRepository,
    PostCommentLikeRepository $postCommentLikeRepository)
  {
    $this->session = new Session();
    $this->userRepository = $userRepository;
    $this->postsRepository = $postsRepository;
    $this->categoryRepository = $categoryRepository;
    $this->postCommentRepository = $postCommentRepository;
    $this->postCommentLikeRepository = $postCommentLikeRepository;
  }


  /**
   * @Route("/api/posts", methods={"GET"})
   */
  public function getForumPosts()
  {
    $posts = $this->postsRepository->findPostsWithCreator();

    // Return posts
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Posts fetched successfully",
      'content' => $posts
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/posts/{postId}", methods={"GET"})
   */
  public function getPost($postId)
  {
    $post = $this->postsRepository->findPostByid($postId);

    if (!$post) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Post not found',
      ));
    }

    // Return post
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Post fetched successfully",
      'content' => $post
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }

  /**
   * @Route("/api/posts", methods={"POST"})
   */
  public function addPost(Request $request)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user
    $user = $this->userRepository->findOneById($parameters['creator']);

    // Get category
    $category = $this->categoryRepository->findOneById($parameters['category']);
    //$category = $parameters['category'];

    if (!$user || !$category) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User or category not found',
      ));
    }

    // Create new post
    $post = new Post();
    $post->setTitle($parameters['title']);
    $post->setSubtitle('');
    $post->setBody($parameters['body']);
    $post->setCreator($user);
    $post->setCategory($category);
    $post->setApproved(true);
    $post->setViews(0);
    $post->setPhoto('default.png');
    $post->setCreatedAt(new \DateTime());

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($post);
    $em->flush();

    // Return created post
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "Post created successfully",
      'content' => $post,
      'username' => $user->getUsername()
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/posts/{postId}", methods={"DELETE"})
   */
  public function deletePost($postId)
  {
    // Get post
    $post = $this->postsRepository->findOneBy(['id' => $postId]);

    if (!$post) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Post not found',
      ));
    }

    // Remove from DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($post);
    $em->flush();

    // Return created post
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Post deleted successfully",
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/posts/{postId}/comments", methods={"GET"})
   */
  public function getComments($postId)
  {
    // Get post
    $post = $this->postsRepository->findOneBy(['id' => $postId]);

    if (!$post) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Post not found',
      ));
    }

    // Get comments
    $comments = $this->postCommentRepository->findByPostIdWithLikes($postId);

    // Return post comments
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Post comments fetched successfully",
      'comments' => $comments
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/posts/{postId}/comments", methods={"POST"})
   */
  public function addComment(Request $request, $postId)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user
    $user = $this->userRepository->findOneById($parameters['creator']);

    // Get post
    $post = $this->postsRepository->findOneById((int) $postId);

    if (!$user || !$post) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User or post not found',
      ));
    }

    // Create new post
    $postComment = new PostComment();
    $postComment->setCreator($user);
    $postComment->setPost($post);
    $postComment->setComment($parameters['comment']);
    $postComment->setCreatedAt(new \DateTime());

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($postComment);
    $em->flush();

    // Return created post
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "Post comment added successfully",
      'commentId' => $postComment->getId(),
      'username' => $user->getUsername()
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/posts/{postId}/comments/{commentId}", methods={"DELETE"})
   */
  public function deleteComment($commentId)
  {
    // Get comment
    $comment = $this->postCommentRepository->findOneBy(['id'=> $commentId]);

    if (!$comment) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Post comment not found',
      ));
    }

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($comment);
    $em->flush();

    // Return created post
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Post comment deleted successfully"
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/posts/{postId}/comments/{commentId}/likes", methods={"GET"})
   */
  public function getCommentLikes($postId, $commentId)
  {
    // Get comment
    $comment = $this->postCommentRepository->findOneById($commentId);

    if (!$comment) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User or post not found',
      ));
    }

    // Get comment likes
    $likes = $this->postCommentLikeRepository->findByCommentId($commentId);

    // Return comment likes
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Post comment likes fetched successfully",
      'likes' => $likes
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/posts/{postId}/comments/{commentId}/likes", methods={"POST"})
   */
  public function likeOrDislikeComment(Request $request, $postId, $commentId)
  {
    // Decode json request
    $parameters = json_decode($request->getContent(), true);

    // Get user
    $user = $this->userRepository->findOneById($parameters['creator']);

    // Get comment
    $comment = $this->postCommentRepository->findOneById($commentId);

    if (!$user || !$comment) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'User or comment not found',
      ));
    }

    $postCommentLike = new PostCommentLike();
    $postCommentLike->setCreator($user);
    $postCommentLike->setComment($comment);
    $postCommentLike->setCreatedAt(new \DateTime());
    $postCommentLike->setType($parameters['type']);

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($postCommentLike);
    $em->flush();

    // Return created post
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_CREATED,
      'message' => "Post comment like added successfully",
      'likeId' => $postCommentLike->getId(),
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/posts/{postId}/comments/{commentId}/likes/{likeId}", methods={"DELETE"})
   */
  public function unlikeDislikeComment($likeId)
  {
    // Get like
    $like = $this->postCommentLikeRepository->findOneBy(['id'=> $likeId]);

    if (!$like) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Post comment like not found',
      ));
    }

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->remove($like);
    $em->flush();

    // Return created post
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Post comment like deleted successfully"
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  /**
   * @Route("/api/posts/{postId}/comments/{commentId}/likes/{likeId}", methods={"PUT"})
   */
  public function switchLikeOrDislike($likeId)
  {
    // Get like
    $like = $this->postCommentLikeRepository->findOneBy(['id'=> $likeId]);

    if (!$like) {
      return new JsonResponse(array(
        'code' => Response::HTTP_NOT_FOUND,
        'message' => 'Post comment like not found',
      ));
    }

    // Switch like to dislike, or the opposite
    if ($like->getType() === 'like') {
      $like->setType('dislike');
    } else {
      $like->setType('like');
    }

    // Add to DB
    $em = $this->getDoctrine()->getManager();
    $em->persist($like);
    $em->flush();

    // Return created post
    $serializer = $this->container->get('serializer');
    $response = [
      'code' => Response::HTTP_OK,
      'message' => "Request processed successfully"
    ];
    $responseJson = $serializer->serialize($response, 'json');
    return new Response($responseJson);
  }


  ///**
  // * @Route("/api/addPost/{idCat}",name="addPost")
  // * @Method({"POST"})
  // */
  /*public function addPostToForumAction(Request $request, TokenStorageInterface $tokenStorage, $idCat, SerializerInterface $serializer)
  {
    //$user= $this->getUser();

    $body = $request->getContent();
    $em = $this->getDoctrine()->getManager();
    $category = $em->getRepository(PostCategory::class)
      ->find($idCat);
    $user = $this->get("security.token_storage")->getToken()->getUser();
    $data = $serializer->deserialize($body, Post::class, 'json');
    $post = new Post();

    // $user = $em->getRepository(User::class)->find($id);
    $post->setTitle($data->getTitle());
    $post->setSubtitle($data->getSubtitle());
    $post->setBody($data->getBody());
    $post->setCreator($user);
    $post->setCategory($category);
    $post->setApproved(true);
    $post->setViews(0);
    $post->setPhoto('default.png');
    $post->setCreatedAt(new \DateTime('now'));

    $em->persist($post);

    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'Post created!',
      'errors' => null,
      'result' => $data

    );
    return new JsonResponse($response, 200);
  }*/


  ///**
  // * @Route("/rest/forumPosts",name="forumPosts")
  // * @Method({"GET"})
  // */
  /*public function getAllPostsForum()
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $covs = $this->getDoctrine()
      ->getRepository(Post::class)
      ->createQueryBuilder('p')
      ->select("p, c, u")
      ->leftJoin('p.creator', 'c')
      ->leftJoin('p.category', 'u')
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($covs));

    return $response;
  }*/

  ///**
  // * @Route("/rest/getCatsForum",name="getCatsForum")
  // * @Method({"GET"})
  // */
  /*public function getAllCats()
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $cats = $this->getDoctrine()
      ->getRepository(PostCategory::class)
      ->createQueryBuilder('q')
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($cats));

    return $response;
  }*/

  ///**
  // * @Route("/rest/postByCat/{idCat}")
  // */
  /*public function getByName($idCat)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $post = $this->getDoctrine()
      ->getRepository(Post::class)
      ->createQueryBuilder('p')
      ->select("p, c, u")
      ->leftJoin('p.creator', 'c')
      ->leftJoin('p.category', 'u')
      ->where('p.category = :id')
      ->setParameter('id', $idCat)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($post));

    return $response;
  }*/

  ///**
  // * @Route("/rest/getOnePost/{id}")
  // */
  /*public function getOnePost($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $post = $this->getDoctrine()
      ->getRepository(Post::class)
      ->createQueryBuilder('p')
      ->select("p, c, u")
      ->leftJoin('p.creator', 'c')
      ->leftJoin('p.category', 'u')
      ->where('p.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();

    $response->setContent(json_encode($post));

    return $response;
  }*/

  ///**
  // * @Route("/rest/getCommentsByPost/{id}",name="get_comments_by_post")
  // * @Method({"GET"})
  // */
  /*public function GetCommentsbyPost($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $notifications = $this->getDoctrine()
      ->getRepository(PostComment::class)
      ->createQueryBuilder('p')
      ->select("p, u")
      ->leftJoin('p.creator', 'u')
      ->where('p.post = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($notifications));
    return $response;
  }*/


  ///**
  // * @Route("/api/addCommentToPost/{idPost}",name="addCommentToPost")
  // * @Method({"POST"})
  // */
  /*public function AddCommentToPost(Request $request, TokenStorageInterface $tokenStorage, $idPost, SerializerInterface $serializer)
  {
    //$user= $this->getUser();

    $body = $request->getContent();
    $em = $this->getDoctrine()->getManager();
    $post = $em->getRepository(Post::class)
      ->find($idPost);
    $user = $this->get("security.token_storage")->getToken()->getUser();
    $data = $serializer->deserialize($body, PostComment::class, 'json');
    $comment = new PostComment();

    // $user = $em->getRepository(User::class)->find($id);
    $comment->setComment($data->getComment());
    $comment->setCreator($user);
    $comment->setPost($post);
    $comment->setCreatedAt(new \DateTime('now'));

    $em->persist($comment);

    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'Post created!',
      'errors' => null,
      'result' => $data

    );
    return new JsonResponse($response, 200);
  }*/

  ///**
  // * @Route("/api/addLikeToPost/{idPost}",name="addLikeToPost")
  // * @Method({"POST"})
   //*/
  /*public function addLikeTopPost(Request $request, TokenStorageInterface $tokenStorage, $idPost)
  {
    //$user= $this->getUser();

    $body = $request->getContent();
    $em = $this->getDoctrine()->getManager();
    $post = $em->getRepository(Post::class)
      ->find($idPost);
    $user = $this->get("security.token_storage")->getToken()->getUser();
    // $data = $this->get('jms_serializer')->deserialize($body, PostLike::class, 'json');
    $like = new PostLike();

    // $user = $em->getRepository(User::class)->find($id);

    $like->setCreator($user);
    $like->setPost($post);
    $like->setCreatedAt(new \DateTime('now'));

    $em->persist($like);

    $em->flush();

    $response = array(
      'code' => 0,
      'message' => 'Like Added to post!',
      'errors' => null,
      'result' => $like

    );
    return new JsonResponse($response, 200);
  }*/

  ///**
  // * @Route("/rest/getLikesByPost/{id}",name="get_likes_by_post")
  // * @Method({"GET"})
  // */
  /*public function getLikesByPost($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $notifications = $this->getDoctrine()
      ->getRepository(PostLike::class)
      ->createQueryBuilder('p')
      ->select("p")
      ->where('p.post = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($notifications));
    return $response;
  }*/

  ///**
  // * @Route("/api/getQuotesByCompany/{id}",name="get_quotes_by_company")
  // * @Method({"GET"})
  // */
  /*public function getQuotesbyCompay($id)
  {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $notifications = $this->getDoctrine()
      ->getRepository(ServiceOfferUser::class)
      ->createQueryBuilder('p')
      ->select("p, c, u")
      ->leftJoin('p.service', 'c')
      ->leftJoin('p.user', 'u')
      ->where('p.company = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getArrayResult();
    $response->setContent(json_encode($notifications));
    return $response;
  }*/
}
