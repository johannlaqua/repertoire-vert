<?php

namespace App\Controller;

use App\Entity\Ads;
use App\Entity\CommentReport;
use App\Entity\ForumAds;
use App\Entity\Post;
use App\Entity\PostCategory;
use App\Entity\PostComment;
use App\Entity\PostLike;

use App\Entity\Report;
use App\Entity\TarifAdsUser;
use App\Entity\User;
use App\Form\PostType;
use App\Repository\PostLikeRepository;
use Doctrine\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
use Troopers\AlertifyBundle\Helper\AlertifyHelper;

class ForumController extends AbstractController
{
    private $logger;
    /**
     * Undocumented function
     *
     * @param \Psr\Log\LoggerInterface $dbLogger
     */
    public function __construct(LoggerInterface $dbLogger)
    {
        $this->logger = $dbLogger;
    }

    public function addPostAction(Request $request ,AlertifyHelper $alertify)
    {
$getUserStatus=$this->getUser()->getActived();
if($getUserStatus==false){
    return  $this->redirectToRoute('home');
}else{


        $post = new Post();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $titre=$post->getTitle();

            $file = $post->getPhoto();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('post_directory'), $filename);
            $post->setPhoto($filename);
            $post->setCreator($this->getUser());
            $post->setApproved(true);
            $post->setCreatedAt(new \DateTime('now'));
            $post->setViews(0);
            $em->persist($post);
            $em->flush();


            $alertify->congrat('Congratulation !');
            // if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            //  return new RedirectResponse('/');
        }

        return $this->render('forum/addpost.html.twig', array(
            "Form" => $form->createView()
        ));
    }}
    public function UpdateanAction(Request $request, $id){
        $ref = $request->headers->get('referer');
        $em = $this->getDoctrine()->getManager();
        $an = $em->getRepository(Post::class)->find($id);

        $gedmo=$em->getRepository('Gedmo\Loggable\Entity\LogEntry');
        $logs=$gedmo->getLogEntries($an);


         $form = $this->createForm(PostType::class, $an);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($an);
            $em->flush();
            return $this->redirectToRoute('ListAllPostsGeneralInForum');
        }
        return $this->render('forum/updatePost.html.twig', array(
            "Form" => $form->createView()
        ));
    }
public function getForumAds(){
    $em = $this->getDoctrine()->getManager();
    $forumAds = $em->getRepository(ForumAds::class)->findAll();

    return $forumAds;
}
    public function listAllPostsSuggestionAction(Request $request)
    {
        //ads will be added here
        $em = $this->getDoctrine()->getManager();
        $ads = $em->getRepository(Ads::class)
            ->createQueryBuilder('p')
            ->select("p, c,u")
            ->leftJoin('p.location', 'c')
            ->leftJoin('p.creator', 'u')
            ->getQuery()
            ->getArrayResult();


$adsbyPack=$this->displayallAdsbyPacks();
        $em = $this->getDoctrine()->getManager();
$forumAds=$this->getForumAds();
        $topPosts=$this->topEventAction();
        $cats=$this->getDoctrine()
            ->getRepository(PostCategory::class)
            ->createQueryBuilder('q')
            ->select("q")
            ->getQuery()
            ->getArrayResult();
        $allPosts=$em -> getRepository(Post::class)
            ->FindAcceptedEv();
        $posts=$this->getDoctrine()
            ->getRepository(Post::class)
            ->createQueryBuilder('p')
            ->select("p, c")
            ->leftJoin('p.category', 'c')
            ->where('p.category = :id')
            ->setParameter('id', 1)
            ->getQuery()
            ->getArrayResult();
        $postsGen = $this->getDoctrine()
            ->getRepository(Post::class)
            ->createQueryBuilder('p')
            ->select("p, c")
            ->leftJoin('p.category', 'c')
            ->where('p.category = :id')
            ->setParameter('id', 2)
            ->getQuery()
            ->getArrayResult();

        $postsSupp = $this->getDoctrine()
            ->getRepository(Post::class)
            ->createQueryBuilder('p')
            ->select("p, c")
            ->leftJoin('p.category', 'c')
            ->where('p.category = :id')
            ->setParameter('id', 3)
            ->getQuery()
            ->getArrayResult();
        return $this->render('forum/listAllPosts.html.twig'
            ,array(
                "posts"=>$posts,
                "postsGen"=>$postsGen,
                "postsSupp"=>$postsSupp,
                "allPosts"=>$allPosts,
                "cats"=>$cats,
                "topPosts" => $topPosts,
                "forumAds"=>$forumAds,
                "ads"=>$ads,
                "adsbyPack"=>$adsbyPack
            ));
    }

    public function listAllPostsGeneralAction()
    {
        $genPosts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->createQueryBuilder('q')
            ->andWhere('q.category = :id')
            ->setParameter('id', 2)
            ->getQuery()
            ->getArrayResult();
        return $this->render('forum/listAllPosts.html.twig'
            ,array(
                "genPosts"=>$genPosts

            ));
    }


    public function searchPostAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $posts =  $em->getRepository('App:Post')->findPostEntitiesByString($requestString);
        if(!$posts) {
            $result['posts']['error'] = "Aucun résultat trouvé 😞 ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($posts){
        foreach ($posts as $posts){
            $realEntities[$posts->getId()] = [$posts->getPhoto(),$posts->getTitle()];

        }
        return $realEntities;
    }


    public function ShowdetailedPostAction($id, Post $post){
        $em = $this->getDoctrine()->getManager();
        $an = $em->getRepository(Post::class)->find($id);
        $post->setViews($post->getViews()+1);
        $em->persist($post);
        $em->flush();
        return $this->render('forum/detailedPost.html.twig', array(
            'title'=>$an->getTitle(),
            'subtitle'=>$an->getSubtitle(),
            'createdAt'=>$an->getCreatedAt(),
            'body'=>$an->getBody(),
            'views'=>$an->getViews(),
            'creator'=>$an->getCreator(),
            'posts'=>$an,
            'comments'=>$an,
            'photo'=>$an->getPhoto(),
            'id'=>$id
        ));
    }

    public function addCommentAction(Request $request, UserInterface $user)
    {
        //if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
        //   return new RedirectResponse('/login');
        //}
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'unable to access this page.');

        $ref = $request->headers->get('referer');

        $annonce = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findPostByid($request->request->get('post_id'));

        $comment = new PostComment();

        $comment->setCreator($user);
        $comment->setPost($annonce);
        $comment->setComment($request->request->get('comment'));
        $comment->setCreatedAt(new \DateTime('now'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        $this->addFlash(
            'info', 'Commentaire publié !.'
        );

        return $this->redirect($ref);

    }



    public function PostsByCategoryAction($id)
    {
        $posts=$this->getDoctrine()
            ->getRepository(Post::class)
            ->createQueryBuilder('p')
            ->select("p, c,u")
            ->leftJoin('p.creator', 'c')
            ->leftJoin('p.category', 'u')
            ->where('p.category = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
        $cats=$this->getDoctrine()
            ->getRepository(PostCategory::class)
            ->createQueryBuilder('q')
            ->select("q")
            ->getQuery()
            ->getArrayResult();
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(PostCategory::class)->find($id);
        return $this->render('forum/PostsByCategory.html.twig'
            ,array(
                "posts"=>$posts,
                "cats"=>$cats,
                'name'=>$cat->getName(),


            ));
    }


    /**
     * @param Post $post
     * @param ObjectManager $manager
     * @param PostLikeRepository $repository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */

    public function likeAction(
        Post $post,  ObjectManager $objectManager
        ,PostLikeRepository $annonceLikeRepository

    ): response{


        $user = $this->getUser();
        if (!$user) return $this->json([
            'code' => 403,
            'message' => 'Unauthorized'
        ], 403);
        if ($post->isLikeByUser($user)) {
            $like = $annonceLikeRepository->findOneBy([
                'post' => $post,
                'user' => $user
            ]);
            $objectManager->remove($like);
            $objectManager->flush();
            return $this->json([
                'code' => 200,
                'message' => 'Like supprimeé',
                'likes' => $annonceLikeRepository->count(['post' => $post])
            ], 200);
        }
        $like = new PostLike();
        $like->setPost($post);
        $like->setCreator($user);
        $like->setCreatedAt(new \DateTime('now'));
        $objectManager->persist($like);
        $objectManager->flush();
        return $this->json([
            'code' => 200,
            'message' => 'Like bien ajouté',
            'likes' => $annonceLikeRepository->count(['post' => $post])
        ], 200);
    }
public function getAllCatsAction(){
    $cats=$this->getDoctrine()
        ->getRepository(PostCategory::class)
        ->createQueryBuilder('q')
        ->select("q")
        ->getQuery()
        ->getArrayResult();
    return $this->render('forum/listAllPosts.html.twig'
        ,array(
            "cats"=>$cats

        ));
}

    public function filterPoststAction(Request $request){
        $type = $request->get('type');
        $em = $this->getDoctrine()->getManager();
        $filteredPosts = $em->getRepository(Post::class)
            ->FindByDate($type);
        return $this->render("forum/PostsByCategory.html.twig",array(
            "filteredPosts"=>$filteredPosts,

        ));

    }

    public function PostsByUser($id)
    {
        $posts=$this->getDoctrine()
            ->getRepository(Post::class)
            ->createQueryBuilder('p')
            ->select("p, c,u")
            ->leftJoin('p.creator', 'c')
            ->leftJoin('p.category', 'u')
            ->where('p.creator = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();

        $cats=$this->getDoctrine()
            ->getRepository(PostCategory::class)
            ->createQueryBuilder('q')
            ->select("q")
            ->getQuery()
            ->getArrayResult();
        $em = $this->getDoctrine()->getManager();
        $cats = $em->getRepository(PostCategory::class)->find($id);
        return $this->render('forum/PostsByAuthor.html.twig'
            ,array(
                "posts"=>$posts,
                "cats"=>$cats,




            ));
    }
    public function topEventAction(){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Post::class)->TopEvent();
        return $event;
    }


    public function reportComment(Request $request, $id)
    {
        $ref = $request->headers->get('referer');
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $user = $this->getUser();
        $comment = $em
            ->getRepository(PostComment::class)
            ->find($id);
        $cr = new CommentReport();
        // $user = $em->getRepository(User::class)->find($id);
        $cr->setUser($user);
        $cr->setComment($comment);

        $cr->setCreatedAt(new \DateTime('now'));
        $em->persist($cr);
        $em->flush();
        $this->addFlash(
            'danger', 'Commentaire signalé !.'
        );
        return $this->redirect($ref);

    }


    public function reportUser(Request $request, $id)
    {
        $ref = $request->headers->get('referer');
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $user = $this->getUser();
        $owner = $em
            ->getRepository(User::class)
            ->find($id);
        $cr = new Report();
        // $user = $em->getRepository(User::class)->find($id);
        $cr->setCreator($user);
        $cr->setOwner($owner);
        $cr->setUrgent(true);
        $cr->setStatus('pending');
        $cr->setDecision('pending');
        $cr->setReason('Commentaire inapproprié');
        $cr->setReasondetails('Commentaire inapproprié');
        $em->persist($cr);
        $em->flush();
        $this->addFlash(
            'danger', 'Utilisateur signalé !.'
        );
        return $this->redirect($ref);

    }
    public function displayallAdsbyPacks()
    {



        $em = $this->getDoctrine()->getManager();
        $myTarifAds = $em->getRepository(TarifAdsUser::class)->findAll();

        return $myTarifAds;
    }
}
